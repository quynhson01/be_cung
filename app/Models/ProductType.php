<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $table ="product_types"; 

    public function products(){
    	return $this->hasMany('App\Models\Product','id_type','id');
    }

    public function faShion(){
    	return $this->belongsTo('App\Models\Fashion','id_fashion','id')->withDefault();
    }

    public function saleBanner(){
    	return $this->hasMany('App\Models\SaleBanner','id_type','id')->withDefault();
    }
}
