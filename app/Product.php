<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
    	'name', 'description', 'user_id',
	];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pins()
    {
        return $this->hasMany('App\Pin');
    }
}
