<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Author;
use App\Helper\Helpers;
use App\Helper\TableSSP;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class bookController extends Controller
{
    function showbook(Request $request)
    {
        return view('book/showbook');
    }

    public function listBook(Request $request)
    {
        if ($request->ajax()) {
            // Fetch the books with related category and author
            $data = Book::with('author', 'category')->select('books.*');

            // Return the DataTable
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category_name', function ($row) {
                    return $row->category ? $row->category->category_name : 'N/A'; // Assuming 'category_name' is the column in 'categories' table
                })
                ->addColumn('author_name', function ($row) {
                    return $row->author ? $row->author->author_name : 'N/A'; // Assuming 'author_name' is the column in 'authors' table
                })
                ->addColumn('select', function ($row) {
                    return '<label class="container">
                                <input type="checkbox" class="select-row item-checkbox" name="selected_books[]" value="' . $row->id . '">
                                <svg viewBox="0 0 64 64" height="1.2em" width="1.5em">
                                    <path d="M 0 16 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 16 L 32 48 L 64 16 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 16" pathLength="575.0541381835938" class="path"></path>
                                </svg>
                            </label>';
                })
                ->rawColumns(['select']) // Removed 'action' since it wasn't defined
                ->make(true);
        }
    }
    function addbook(Request $request)
    {

        try {
            DB::beginTransaction();
            $existingbook = Book::where('title', $request->title)->first();

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
