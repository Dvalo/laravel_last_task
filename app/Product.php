<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable=[
    	"title","description","img_path","category_id"
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Categories', 'product_categories', 'products_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}