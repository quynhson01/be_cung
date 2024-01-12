<?php

namespace App\Repositories;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Product;
use App\Models\Size;

class OrderAllRepository
{
    public function getOrder()
    {
        return Bill::all();
    }
    
    public function getReceivedActiveNone($id)
    {
        $received_active = Bill::find($id);
        $received_active->status = Bill::Status_Received;
        $received_active->save();
        return $received_active;
    }

    public function getReceivedActive($id)
    {
        $received_active = Bill::find($id);
        $received_active->status = Bill::Status_Received;
        $received_active->save();
        $bill_details = $received_active->billdetail;
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
                    $product_remain = $product_qty - $qty;
                    $product->quantity = $product_remain;
                    $product->sold_quantity = $pro_sold + $qty;
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
                    $size_remain = $size_qty - $qty_size;
                    $size->quantity = $size_remain;
                    $size->sold_quantity = $size_sold + $qty_size;
                    $size->save();
                }
            }
        }
    }

    public function getMovedActiveNone($id)
    {
        $moved_active = Bill::find($id);
        $moved_active->status = Bill::Status_Moved;
        $moved_active->save();
        return $moved_active;
    }

    public function getMovedActive($id)
    {
        $moved_active = Bill::find($id);
        $moved_active->status = Bill::Status_Moved;
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
                    $product_remain = $product_qty - $qty;
                    $product->quantity = $product_remain;
                    $product->sold_quantity = $pro_sold + $qty;
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
                    $size_remain = $size_qty - $qty_size;
                    $size->quantity = $size_remain;
                    $size->sold_quantity = $size_sold + $qty_size;
                    $size->save();
                }
            }
        }
    }

    public function getCompleteActiveNone($id)
    {
        $complete_active = Bill::find($id);
        $complete_active->status = Bill::Status_Complete;
        $complete_active->save();
        return $complete_active;
    }

    public function getCompleteActive($id)
    {
        $complete_active = Bill::find($id);
        $complete_active->status = Bill::Status_Complete;
        $complete_active->save();
        $bill_details = $complete_active->billdetail;
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
                    $product_remain = $product_qty - $qty;
                    $product->quantity = $product_remain;
                    $product->sold_quantity = $pro_sold + $qty;
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
                    $size_remain = $size_qty - $qty_size;
                    $size->quantity = $size_remain;
                    $size->sold_quantity = $size_sold + $qty_size;
                    $size->save();
                }
            }
        }
    }

    public function getCancelActiveNone($id)
    {
        $cancel_active = Bill::find($id);
        $cancel_active->status = Bill::Status_Cancel;
        $cancel_active->save();
        return $cancel_active;
    }

    //cộng lại số lượng sản phẩm về kho
    public function getCancelActive($id)
    {
        $cancel_active = Bill::find($id);
        $cancel_active->status = Bill::Status_Cancel;
        $cancel_active->save();
        $bill_details = $cancel_active->billdetail;
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
        return Bill::whereBetween('date_order', [$request->from, $request->to])->get();
    }

    public function getDelete($id)
    {
        $bill = Bill::find($id);
        $bill_detail = BillDetail::where('id_bill', $id);
        $bill_detail->delete();
        $bill->delete();
        return $bill;
    }
}
