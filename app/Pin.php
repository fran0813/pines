<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    protected $table = "pins";

    protected $fillable = [
    	'number', 'product_id',
	];

	public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
