<?php

namespace App\Repositories;

use App\Models\Bill;
use App\Models\BillDetail;

class OrderCompleteRepository
{
    public function getOrder(){
        return Bill::where('status',2)->get();
    }

    public function getDelete($id){
        $bill = Bill::find($id);
        $bill_detail = BillDetail::where('id_bill',$id);
        $bill_detail->delete();
        $bill->delete();
        return $bill;
    }

    public function getSearch($request)
    {
        return Bill::where('status',2)->whereBetween('date_order', [$request->from, $request->to])->get();
    }
}
