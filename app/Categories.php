<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
	protected $table = 'categories';
    protected $fillable=[
    	"name","parent_id"
    ];

    public function parent() {
	    return $this->belongsTo('App\Categories', 'parent_id'); //get parent category
	}

	public function children() {
	    return $this->hasMany('App\Categories', 'parent_id'); //get all subs. NOT RECURSIVE
	}

	public function products()
    {
        return $this->belongsToMany('App\Product', 'product_categories', 'products_id');
    }
}
