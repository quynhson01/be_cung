<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fashion extends Model
{
    use HasFactory;

    protected $table ="fashion";

    const On_Cate = 1;
    const Off_Cate = 0;

    public function productType(){
    	return $this->hasMany('App\Models\ProductType','id_fashion','id');
    }
}
