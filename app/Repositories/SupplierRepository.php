<?php

namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository
{  
    public function getSuppliers(){
        return Supplier::all();
    }

    public function getSupplier($id){
        $supplier = Supplier::find($id);
        return response()->json(['data' => $supplier], 200);
    }

    public function postSupplierAdd($request){
        $image='';
        if($request->hasfile('img'))
        {
            $file = $request->file('img');
            $image=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('frontend\image\brands'); //project\public\images\cars, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $image); //lưu hình ảnh vào thư mục public/images
        }
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->image = $image;
        $supplier->save();
        return $supplier;
    }

    public function postSupplierEdit($request){
        $image='';
        if($request->hasfile('img'))
        {
            $file = $request->file('img');
            $image=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('frontend\image\brands'); //project\public\images\cars, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $image); //lưu hình ảnh vào thư mục public/images
        }
        $supplier = Supplier::find($request->id);
        $supplier->name = $request->name;
        if($request->hasfile('img')){
            $supplier->image = $image;
        }
        $supplier->save();
        return $supplier;
    }

    public function getSupplierDelete($id){
        $supplier = Supplier::destroy($id);
        return $supplier;
    }
}
