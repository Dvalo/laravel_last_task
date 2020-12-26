<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use App\ProductCategories;
use App\Comment;

class ProductController extends Controller
{
    public function index() {
    	$products = Product::get();
        $categories = Categories::doesntHave('parent')->get(); // Get main categories
        $subcategories = Categories::whereHas('parent')->get(); // Get children categories
    	return view("product.index",["products"=>$products,"categories" => $categories, "subcategories" => $subcategories]);
    }

    public function showProduct($id) {
    	$product = Product::where("id", $id)->firstOrFail();
    	$product_categories = Product::with('categories')->find($id);
        $categories = Categories::doesntHave('parent')->get(); // Get main categories
        $subcategories = Categories::whereHas('parent')->get(); // Get children categories
        $comments = Product::with('comments')->find($id);
    	return view("product.single", ["product" => $product,"categories" => $categories, "subcategories" => $subcategories, 
            "product_categories" => $product_categories, "comments" => $comments]);
    }

    public function showProductByCategory($id) {
        $products = Product::whereHas('categories', function($query) use ($id) {
            $query->where('id', $id);
        })->get();
        $categories = Categories::doesntHave('parent')->get(); // Get main categories
        $subcategories = Categories::whereHas('parent')->get(); // Get children categories
        return view("product.index",["products"=>$products,"categories" => $categories, "subcategories" => $subcategories]);
    }
    public function create() {
    	$categories = Categories::get();
    	return view('product.create', ["categories" => $categories]);
    }

    public function store(Request $request) {
		// request()->validate([
  //       	'image' => 'required|image',
  //      	]);

       	if ($files = $request->file('image')) {
	       $destinationPath = public_path('/images/'); // Images folder in public folder
	       $productImage = date('YmdHis') . "." . $files->getClientOriginalExtension(); // Image file name
	       $files->move($destinationPath, $productImage); // Save image
	       $insert['image'] = "$productImage";
	       	$product = Product::create([
	            "title"=>$request->input("title"),
	            "description"=>$request->input("description"),
	            "img_path"=>$productImage,
	        ]);
	        $categories = $request->input('categories');
	        foreach ($categories as $category) {
	            ProductCategories::create([
	                "products_id"=>$product->id,
	                "categories_id"=>$category,
	            ]);
        	}
        }
        return back();
    }
}
