<?php

namespace App\Repositories;

use App\Models\Bill;
use App\Models\Product;
use App\Models\Size;

class OrderMovedRepository
{
    public function getOrder(){
        return Bill::where('status',1)->get();
    }

    public function getCompleteActive($id){
        $complete_active = Bill::find($id);
        $complete_active->status = Bill::Status_Complete;
        $complete_active->save();
        return $complete_active;
    }

    public function getCancelActive($id){
        $moved_active = Bill::find($id);
        $moved_active->status = Bill::Status_Cancel;
        $moved_active->save();
        $bill_details = $moved_active->billdetail;
        $product_ids = [];
        $size_ids = [];
        $product_qtys = [];
        foreach ($bill_details as $bill_detail) {
            $product_ids[] = $bill_detail->id_product;
            $size_ids[] = $bill_detail->id_size;
            $product_qtys[] = $bill_detail->quantity;
        }
        foreach ($product_ids as $key => $product_id) {
            $product = Product::find($product_id);
            $product_qty = $product->quantity;
            $pro_sold = $product->sold_quantity;
            foreach ($product_qtys as $key2 => $qty) {
                if ($key == $key2) {
                    $product_remain = $product_qty + $qty;
                    $product->quantity = $product_remain;
                    $product->sold_quantity = $pro_sold - $qty;
                    $product->save();
                }
            }
        }
        foreach ($size_ids as $key3 => $size_id) {
            $size = Size::find($size_id);
            $size_qty = $size->quantity;
            $size_sold = $size->sold_quantity;
            foreach ($product_qtys as $key4 => $qty_size) {
                if ($key3 == $key4) {
                    $size_remain = $size_qty + $qty_size;
                    $size->quantity = $size_remain;
                    $size->sold_quantity = $size_sold - $qty_size;
                    $size->save();
                }
            }
        }
    }

    public function getSearch($request)
    {
        return Bill::where('status',1)->whereBetween('date_order', [$request->from, $request->to])->get();
    }
}
