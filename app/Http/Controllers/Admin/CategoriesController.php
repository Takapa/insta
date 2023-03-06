<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoriesController extends Controller
{
    private $category;

    public function __construct(Category $category){
        $this->category = $category;
    }
    
    //
    public function index()
    {
        $all_categories = Category::all();

        return view('admin.categories.index')->with('all_categories',$all_categories);
    }

    public function store(Request $request)
    {
        $this->category->name = $request->name;
        $this->category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $category       = $this->category->findOrFail($id);
        $category->name = $request->name;

        $category->save();

        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        $this->category->destroy($id);
        return redirect()->back();
    }

}
