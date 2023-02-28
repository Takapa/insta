<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoriesController extends Controller
{
    //
    public function index()
    {
        $all_categories = Category::latest()->get();

        return view('admin.categories.index')->with('all_categories',$all_categories);
    }
}
