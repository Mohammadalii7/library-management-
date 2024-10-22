<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Jobs\SendReminderEmail;
use App\Models\BorrowingRecord;
use App\Mail\BorrowNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class recordController extends Controller
{
    function showrecord()
    {
        // $record = BorrowingRecord::all();
        return view('records/record');
    }

    public function listrecord(Request $request)
    {
        if ($request->ajax()) {
            $data = BorrowingRecord::select('borrowing_records.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('book_id', function ($row) {
                    return $row->book ? $row->book->title : 'N/A';
                })
                ->addColumn('member_id', function ($row) {
                    return $row->member ? $row->member->name : 'N/A';
                })

                ->addColumn('select', function ($row) {
                    return '<label class="container">
                                <input type="checkbox" class="select-row item-checkbox" name="selected_records[]" value="' . $row->id . '">
                                <svg viewBox="0 0 64 64" height="1.2em" width="1.5em">
                                    <path d="M 0 16 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 16 L 32 48 L 64 16 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 16" pathLength="575.0541381835938" class="path"></path>
                                </svg>
                            </label>';
                })
                ->rawColumns(['select'])
                ->make(true);
        }
    }



    public function borrowBook(Request $request, $id)
    {

        $book = Book::find($id);
        $user = Auth::user();


        $allowedDays = $request->input('allow_days', 30);
        $dayslimit =  $request->input('days_limit', 5);
        $borrowedAt = now();
        $dueDate = now() ->addDays($allowedDays - $dayslimit);
        DB::beginTransaction();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
        try {
            BorrowingRecord::create([
                'member_id' => $request->user()->id,
                'book_id' => $book->id,
                'borrowed_at' => $borrowedAt,
                'due_date' => $dueDate,
                'fine' => 0,
                'returned_at' => null,
            ]);

            $book->copies_available -= 1;
            $book->save();

            // SendReminderEmail::dispatch($user, $book);

            Mail::to($request->user()->email)->send(new BorrowNotification($request->user(), $book));

            DB::commit();

            return redirect('borrow_book')->with('success', 'Book borrowed successfully! A confirmation email has been sent.');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while borrowing the book. Please try again later.');
        }
    }


    public function deleteMultiple(Request $request)
    {


        $recordIds = $request->input('selected_records');

        try {
            DB::transaction(function () use ($recordIds) {
                BorrowingRecord::destroy($recordIds);
            });

             DB::commit();
            return redirect()->back()->with('success', 'Record deleted successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while deleting authors. Please try again.');
        }
    }
}
