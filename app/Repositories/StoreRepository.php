<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Size;

class StoreRepository
{
    public function getStores(){
        return Product::orderBy('id', 'desc')->get();
    }

    public function getSizes($id)
    {
        return Size::where('id_product',$id)->get();
    }

    //nhập thuộc tính
    public function getAddsize($id)
    {
        $size = Product::find($id);
        return response()->json(['data' => $size], 200);
    }

    public function postAddSize($request)
    {
        $quantity = Product::find($request->id);
        $id_product = $quantity->id;
        $size = new Size();
        $size->id_product = $id_product;
        $size->size = $request->size;
        $size->save();
    }

    // Nhập số lượng
    public function getAddQuantity($id)
    {
        $quantity = Size::find($id);
        return response()->json(['quantity' => $quantity], 200);
    }

    public function postAddQuantity($request)
    {
        $size = Size::find($request->id);
        $size->quantity += $request->quantity;
        $size->save();
        $id_product = $size->id_product;
        $quantity = Product::find($id_product);
        $quantity->quantity += $request->quantity;
        $quantity->save();


    }

    public function getEditSize($id)
    {
        $sizeedit = Size::find($id);
        return response()->json(['data' => $sizeedit], 200);
    }

    public function postEditSize($request)
    {
        $size_edit = Size::find($request->id);
        $size_edit->size= $request->size;
        $size_edit->save();
    }

    public function getDeleteSize($id){
        return Size::destroy($id);
    }
}
