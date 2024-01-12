<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleBanner extends Model
{
    use HasFactory;

    protected $table ="sale_banner";

    public function productType(){
    	return $this->belongsTo('App\Models\ProductType','id_type','id')->withDefault();
    }

    const Status_On = 1;
    const Status_Off = 0;
}
