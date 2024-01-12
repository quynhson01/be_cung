<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table ="products";

    const On_Product = 1;
    const Off_Product = 0;
    const Ok_Product = 1;
    const No_Product = 0;

    protected $casts = [
        'images'=>'array'
    ];

    public function productType(){
    	return $this->belongsTo('App\Models\ProductType','id_type','id')->withDefault();
    }

    public function user(){
    	return $this->belongsTo('App\Models\User','id_user','id')->withDefault();
    }

    public function supplier(){
    	return $this->belongsTo('App\Models\Supplier','id_supplier','id')->withDefault();
    }

    public function billdetail(){
    	return $this->hasMany('App\Models\BillDetail','id_product','id')->withDefault();
    }

    public function comment(){
    	return $this->hasMany('App\Models\Comment','id_product','id')->withDefault();
    }

    public function rating(){
    	return $this->hasMany('App\Models\Rating','id_product','id');
    }

    public function size(){
    	return $this->hasMany('App\Models\Size','id_product','id');
    }

}
