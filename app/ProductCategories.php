<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
	//protected $table = 'product_categories';
	//protected $primaryKey = 'products_id';
	public $timestamps = false;

    protected $fillable=[
    	"products_id","categories_id"
    ];


}