<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable=[
    	"user_id","product_id","parent_id","body"
    ];

	public function replies() {
	    return $this->hasMany('App\Comment', 'parent_id');
	}

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
