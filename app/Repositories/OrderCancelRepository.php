<?php

namespace App\Repositories;

use App\Models\Bill;
use App\Models\BillDetail;

class OrderCancelRepository
{
    public function getOrder(){
        return Bill::where('status',3)->get();
    }

    public function getDelete($id){
        $bill = Bill::find($id);
        $bill_detail = BillDetail::where('id_bill',$id);
        $bill_detail->delete();
        $bill->delete();
    }

    public function getSearch($request)
    {
        return Bill::where('status',3)->whereBetween('date_order', [$request->from, $request->to])->get();
    }
}
