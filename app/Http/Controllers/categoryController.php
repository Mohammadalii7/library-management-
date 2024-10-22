<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class categoryController extends Controller
{
    public function showcategory()
    {

        return view('category/categorylist');
    }

    public function listCategory(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select('categories.*');


            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('select', function ($row) {
                    return '<label class="container">
                                <input type="checkbox" class="select-row item-checkbox" name="selected_categories[]" value="' . $row->id . '">
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
            $existingcategory = Category::where('category_name', $request->category_name)->first();

            if ($existingcategory) {
                DB::rollBack();
                return redirect()->back()->with('message', 'This category already exists.');
            }
            $data = new Category;
            $data->category_name = $request->category_name;
            $data->save();
            DB::commit();
            return redirect('category/categorylist')->with('success', 'Category Add Successfully');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }
    function edit($id)
    {
        $user = Category::find($id);
        return view('category/updatecategory', compact('user'));
    }
    function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $author = Category::find($request->id);
            $author->category_name = $request->category_name;

            $author->save();
            DB::commit();
            return redirect('category/categorylist')->with('success', 'Author Update Successfully');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }



    public function deleteMultiple(Request $request)
    {
        try {


            $categoryIds = $request->input('selected_categories');


            $categoriesWithBooks = Category::whereIn('id', $categoryIds)
                ->whereHas('books')
                ->pluck('id');

            if ($categoriesWithBooks->isNotEmpty()) {
                return redirect()->back()->with('error', 'Sorry! The selected category is currently used in books');
            }


            DB::transaction(function () use ($categoryIds) {
                Category::destroy($categoryIds);
            });
            DB::commit();
            return redirect()->back()->with('success', 'Categories deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while deleting categories. Please try again.');
        }
    }

    // public function softDelete($id)
    // {
    //     $book = Category::findOrFail($id);
    //     $book->delete(); 

    //     return redirect()->back()->with('success','Soft Delete Successfully');
    // }
}
