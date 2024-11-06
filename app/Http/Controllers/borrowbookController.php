<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Mail\FineNotification;
use App\Models\BorrowingRecord;
use App\Jobs\SendFineNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class borrowbookController extends Controller
{

    public function showProfile()
    {
        $user = Auth::user();

        $borrowedBooks = BorrowingRecord::with('book', 'book.author')
            ->where('member_id', $user->id)
            ->whereNull('returned_at')
            ->get();


        return view('borrow_book', compact('borrowedBooks'));
    }


    public function returnBook(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $borrowingRecord = BorrowingRecord::where('book_id', $id)
                ->where('member_id', $request->user()->id)
                ->whereNull('returned_at')
                ->first ();


            if (!$borrowingRecord) {
                return redirect()->back()->with('error', 'You have not borrowed this book.');
            }

            $borrowedAt = Carbon::parse($borrowingRecord->borrowed_at);
            $returnedAt = Carbon::now();

            $totaldays = $borrowedAt->diffInRealDays($returnedAt);
            $fineAmount = 0;


            $allowedDays = $borrowingRecord->allow_days ?? 30;

            $daysLate = 0;

            if ($totaldays > $allowedDays) {
                $daysLate = ceil($totaldays - $allowedDays);
                $fineAmount = ceil($daysLate * 5);
            }

            $borrowingRecord->returned_at = $returnedAt;
            $borrowingRecord->fine = $fineAmount;
            $borrowingRecord->save();
            DB::commit();

            $book = Book::find($id);
            if ($book) {
                $book->copies_available += 1;
                $book->save();
            }
            $user = $request->user();

            if ($fineAmount > 0) {
                SendFineNotification::dispatch($user, $book, $daysLate, $fineAmount);

                return redirect()->back()->with('message', 'Book Returned Successfully. You have a fine of $' . $fineAmount . ' for being ' . $daysLate . ' days late.');
            } else {
                return redirect()->back()->with('success', 'Book Returned Successfully.');
            }
        } catch (\Exception $e) {

            dd($e);
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while processing your return. Please try again later.');
        }
    }
}
