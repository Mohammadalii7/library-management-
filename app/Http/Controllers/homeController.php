<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\BorrowingRecord;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index()
    {
        try {
            if (Auth::id()) {
                $usertype = Auth::guard('web')->user()->role;


                if ($usertype === 'admin') {

                    return redirect('dashboard');
                } elseif ($usertype === 'member') {

                    $data = Book::all();
                    return view('home', compact('data'));
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }


    public function bookdetail($id)
    {
        $data = Book::find($id);
        return view('book_detail', compact('data'));
    }
}
