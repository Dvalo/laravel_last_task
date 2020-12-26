<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class CategoryController extends Controller
{
    public function index() {
    	$id = 2;
    	$categories = Categories::doesntHave('parent')->get(); // Get main categories
    	$subcategories = Categories::whereHas('parent')->get(); // Get children categories

        return view('admin.index', ["categories" => $categories, "subcategories" => $subcategories]);
    }

    public function create() {
        $categories = Categories::doesntHave('parent')->get();
        return view('category.create', ["categories" => $categories]);
    }

    public function store(Request $request) {
        Categories::create([
            "name"=>$request->input("title"),
            "parent_id"=>$request->input("parent_category")
        ]);
        return back();
    }
}
