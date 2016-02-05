<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Product extends Model
{
    //
    protected $fillable = ['name', 'description', 'image', 'price', 'status'];

    public function user(){

    	return $ths->belongsTo('App\User');
    }

}
