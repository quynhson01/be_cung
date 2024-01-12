<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table ="bills";

    const Status_Received = 0;
    const Status_Moved = 1;
    const Status_Complete = 2;
    const Status_Cancel = 3;
    
    public function user(){
    	return $this->belongsTo('App\Models\User','id_user','id')->withDefault();
    }

    public function billdetail(){
    	return $this->hasMany('App\Models\BillDetail','id_bill','id');
    }
}
