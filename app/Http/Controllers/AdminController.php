<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;

class AdminController extends Controller
{
    public function index() {
    	$products = Product::get();
    	return view("admin.index",["products" => $products]);
    }

    public function edit($id){
    	$product = Product::where("id",$id)->firstOrFail();
    	$categories = Categories::get();
    	return view("admin.productedit",["product"=>$product, "categories"=>$categories]);
    }

    public function update(Request $request) {
    	Product::where("id",$request->input("id"))->update([
            "title"=>$request->input("title"),
            "description"=>$request->input("description"),
    	]);
    	return back();
    }

    public function delete(Request $request) {
    	Product::where("id",$request->input("id"))->delete();
    	return back();
    }
}
