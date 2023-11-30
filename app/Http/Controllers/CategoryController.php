<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate("5");
        $trashBin = Category::onlyTrashed()->paginate("5");
        return view('categories.category', compact('categories','trashBin'));
    }

    public function AddCat(Request $request)
    {
        $validated = $request->validate(['category_name' => 'required|unique:categories|max:255']);
        Category::create(['category_name' => $request->category_name, 'user_id' => Auth::user()->id, 'created_at' => Carbon::now()]);

        return Redirect()->back()->with('success','Category Inserted Successfully');
    }

    public function Edit($id){
        $category = Category::find($id);
        return view('categories.edit-category', compact('category'));
    }

    public function Update(Request $request, $id){
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);

        return Redirect()->route('category')->with('success', 'Updated successfully');
    }

    public function remove($id){
        $remove = Category::find($id)->delete();
        return Redirect()->back()->with('success','Cateogry removed successfully.');
    }

    public function restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category restored successfully.');
    }

    public function delete($id){
        $restore = Category::withTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category deleted succcessfully.');
    }
}
