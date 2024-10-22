<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowingRecord;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    function dashboard()
    {
        try {


            if (Auth::id()) {
                $usertype = Auth::guard('web')->user()->role;


                if ($usertype === 'admin') {

                    $user = Member::all()->count();
                    $book = Book::all()->count();
                    $borrow = BorrowingRecord::all()->count();
                    $returnedBooks = BorrowingRecord::whereNotNull('returned_at')->count();

                    return view('dashboard', compact('user', 'book', 'borrow', 'returnedBooks'));
                } elseif ($usertype === 'member') {

                    return redirect('home');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong'); {
            }
        }
    }
}
