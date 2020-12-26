<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request) {
    	$request->validate([
            'comment_content'=>'required',
        ]);
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        $comment = Comment::create([
            "user_id"=>$input['user_id'],
            "product_id"=>$input["product_id"],
            "parent_id"=>$input["parent_id"],
            "body"=>$input["comment_content"]
        ]);
        return back();
    }
}
