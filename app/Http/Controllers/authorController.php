<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class authorController extends Controller
{
    public function showauthor()
    {
        // $data = Author::all();
        return view('author/author_detail');
    }

    public function listAuthor(Request $request)
    {
        if ($request->ajax()) {
           
            $data = Author::select('authors.*');

     
            return DataTables::of($data)
                ->addIndexColumn()
               
                ->addColumn('select', function ($row) {
                    return '<label class="container">
                                <input type="checkbox" class="select-row item-checkbox" name="selected_authors[]" value="' . $row->id . '">
                                <svg viewBox="0 0 64 64" height="1.2em" width="1.5em">
                                    <path d="M 0 16 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 16 L 32 48 L 64 16 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 16" pathLength="575.0541381835938" class="path"></path>
                                </svg>
                            </label>';
                })
                ->rawColumns(['select']) 
                ->make(true);
        }
    }

    function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $existingAuthor = Author::where('author_name', $request->author_name)->first();

            if ($existingAuthor) {
                DB::rollBack();
                return redirect()->back()->with('error', 'This author already exists.');
            }


            $author = new Author;
            $author->author_name = $request->author_name;
            $author->bio = $request->bio;
            $author->birth_date = $request->birth_date;
            $image = $request->image;

            if ($image) {
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move('author', $imagename);
                $author->image = $imagename;
            }
            $author->save();
            DB::commit();
            return redirect('author/author_detail')->with('success', 'Author Add Successfully');
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();

            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }
    function edit($id)
    {
        $user = Author::find($id);
        return view('author/updateauthor', compact('user'));
    }
    function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $author = Author::find($request->id);
            $author->author_name = $request->author_name;
            $author->bio = $request->bio;
            $author->birth_date = $request->birth_date;
            $image = $request->image;

            if ($image) {
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move('author', $imagename);
                $author->image = $imagename;
            }
            $author->save();
            DB::commit();
            return redirect('author/author_detail')->with('success', 'Author Update Successfully');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }


    public function deleteMultiple(Request $request)
    {
        

        $authorIds = $request->input('selected_authors');

        $authorsWithBooks = Author::whereIn('id', $authorIds)
        ->whereHas('books') // Check for related books
        ->pluck('id');

    if ($authorsWithBooks->isNotEmpty()) {
        return redirect()->back()->with('error', 'Sorry! The selected author is currently used in books');
    }

        try {
            DB::transaction(function () use ($authorIds) {
                Author::destroy($authorIds);
            });

            DB::commit();
            return redirect()->back()->with('success', 'Author   deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
          
            return redirect()->back()->with('error', 'An error occurred while deleting authors. Please try again.');
        }
    }
}
