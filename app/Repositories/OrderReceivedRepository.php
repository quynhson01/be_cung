<?php

namespace App\Repositories;

use App\Models\Bill;
use App\Models\Product;

class OrderReceivedRepository
{
    public function getOrder(){
        return Bill::where('status',0)->latest()->get();
    }

    public function getMovedActive($id){
        $moved_active = Bill::find($id);
        $moved_active->status = Bill::Status_Moved;
        $moved_active->save();
        return $moved_active;
    }

    public function getCancelActive($id){
        $cancel_active = Bill::find($id);
        $cancel_active->status = Bill::Status_Cancel;
        $cancel_active->save();
        return $cancel_active;
    }

    public function getSearch($request)
    {
        return Bill::where('status',0)->whereBetween('date_order', [$request->from, $request->to])->get();
    }
}
