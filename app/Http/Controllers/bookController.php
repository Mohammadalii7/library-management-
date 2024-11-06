<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Author;
use App\Helper\Helpers;
use App\Helper\TableSSP;
use App\Models\BorrowingRecord;
use App\Models\Category;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class bookController extends Controller
{
    function showbook(Request $request)

    {
        //  $data = Book::where('status', 1)->get();
        return view('book/showbook');
    }

    public function listBook(Request $request)
    {
        if ($request->ajax()) {

            $data = Book::with('author', 'category')->select('books.*');


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category_name', function ($row) {
                    return $row->category ? $row->category->category_name : 'N/A';
                })
                ->addColumn('author_name', function ($row) {
                    return $row->author ? $row->author->author_name : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    if ($row->status == 1) {
                        return '<form action="' . url('book/disable', $row->id) . '" method="POST" style="display:inline-block;">
                                    ' . csrf_field() . '
                                    <button type="submit" class="btn btn-danger btn-sm">Disable</button>
                                </form>';
                    } else {
                        return '<form action="' . url('book/enable', $row->id) . '" method="POST" style="display:inline-block;">
                                    ' . csrf_field() . '
                                    <button type="submit" class="btn btn-success btn-sm">Enable</button>
                                </form>';
                    }
                })
                ->rawColumns(['select', 'action'])
                ->make(true);
        }
    }
    function addbook(Request $request)
    {

        try {
            
            DB::beginTransaction();
            $existingbook = Book::where('title', $request->title)->exists();

            if ($existingbook) {
                DB::rollBack();

                return redirect()->back()->with('error', 'This book already exists.');
            }

            $book = new Book();
            $book->title = $request->title;
            $book->description = $request->description;
            $book->published_date = $request->published_date;
            $book->copies_available     = $request->copies_available;

            $book->category_id = $request->category_id;
            $book->author_id = $request->author_id;
            $image = $request->image;

            if ($image) {
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move('books', $imagename);
                $book->image = $imagename;
            }

            $book->save();
            DB::commit();
            return redirect('book/showbook')->with('success', 'Book added successfully');
        } catch (\exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to add book');
        }
    }

    function enable($id)
    {
        try {
            DB::beginTransaction();

            $book = Book::find($id);

            $book->status = 1;
            $book->save();

            DB::commit();
            return redirect()->back()->with('success', 'Book enabled successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to enabled book ');
        }
    }

    function disable($id)
    {
        try {
            DB::beginTransaction();

            $book = Book::find($id);

            $book->status = 0;
            $book->save();

            DB::commit();

            return redirect()->back()->with('success', 'Book disabled successfully');
        } catch (\Exception $e) {
            DB::rollBack();


            return redirect()->back()->with('error', 'Failed to disabled book ');
        }
    }
    function bookform()
    {
        $data = Category::all();
        $user = Author::all();
        return view('book/addbook', compact('data', 'user'));
    }

    function editbook($id)
    {
        $category = Category::all();
        $author = Author::all();
        $book = Book::find($id);
        return view('book/updatebook', compact('book', 'author', 'category'));
    }

    function updatebook(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|unique:books,title',
                'description' => 'nullable|string',
                'published_date' => 'required|date',
                'copies_available' => 'required|integer|min:0',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'author_id' => 'required|exists:authors,id',
            ]);
            $book = Book::find($id);
            $book->title = $request->title;
            $book->description = $request->description;
            $book->published_date = $request->published_date;
            $book->copies_available = $request->copies_available;
            $book->category_id = $request->category_id;
            $book->author_id = $request->author_id;
            $image = $request->image;

            if ($image) {
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move('book', $imagename);
                $book->image = $imagename;
            }
            $book->save();
            DB::commit();
            return redirect('book/showbook')->with('success', 'Book updated successfully');
        } catch (\Exception $e) {

            dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update book');
        }
    }

    public function deleteMultiple(Request $request)
    {


        $bookIds = $request->input('selected_books');

        try {
            DB::transaction(function () use ($bookIds) {
                Book::destroy($bookIds);
            });
            DB::commit();
            return redirect()->back()->with('success', 'Book deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while deleting authors. Please try again.');
        }
    }
}
