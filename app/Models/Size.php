<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = "size";

    public function product(){
    	return $this->belongsTo('App\Models\Product','id_product','id')->withDefault();
    }

    public function bill_detail(){
    	return $this->hasMany('App\Models\BillDetail','id_size','id');
    }
}
