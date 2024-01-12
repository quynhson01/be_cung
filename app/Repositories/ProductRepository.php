<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class ProductRepository
{  
    public function getProducts(){
        $products = Product::all();
        return $products;
    }

    public function getProduct($id){
        $product = Product::find($id);
        return $product;
    }

    public function getProductType(){
        $product_type = ProductType::all();
        return $product_type;
    }

    public function getBrands(){
        return Supplier::all();
    }

    public function postProductAdd($request){
        $image='';
        if($request->hasfile('img'))
        {
            $file = $request->file('img');
            $image=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('frontend\image\product'); //project\public\images\cars, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $image); //lưu hình ảnh vào thư mục public/images
        }

        $images=[];
        if($request->hasfile('imgs'))
        {      
            $files = $request->file('imgs');
            foreach ($files as $key => $file) {
                $file_name = time().'_'.$file->getClientOriginalName();
                $destinationPath=public_path('frontend\image\products'); //project\public\images\cars, //public_path(): trả về đường dẫn tới thư mục public
                $file->move($destinationPath, $file_name); //lưu hình ảnh vào thư mục public/images
                $images[]=$file_name;
           }
        }
        $user = Auth::user();
        $product = new Product();
        $product->id_user = $user->id;
        $product->name = $request->name;
        $product->id_type = $request->type;
        $product->id_supplier = $request->supplier;
        $product->description = $request->description;
        $product->long_description = $request->long_description;
        $product->original_price = $request->original;
        $product->unit_price = $request->price;
        $product->promotion_price = $request->promotion;
        $product->image = $image;
        $product->images = $images;
        $product->save();
        return $product;
    }

    public function postProductEdit($request,$id){
        $image='';
        if($request->hasfile('img'))
        {
            $file = $request->file('img');
            $image=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('frontend\image\product'); //project\public\images\cars, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $image); //lưu hình ảnh vào thư mục public/images
        }

        $images=[];
        if($request->hasfile('imgs'))
        {      
            $files = $request->file('imgs');
            foreach ($files as $key => $file) {
                $file_name=time().'_'.$file->getClientOriginalName();
                $destinationPath=public_path('frontend\image\products'); //project\public\images\cars, //public_path(): trả về đường dẫn tới thư mục public
                $file->move($destinationPath, $file_name); //lưu hình ảnh vào thư mục public/images
                $images[]=$file_name;
           }
        }
        $product = Product::find($id);
        $product->name = $request->name;
        $product->id_type = $request->type;
        $product->id_supplier = $request->supplier;
        $product->description = $request->description;
        $product->long_description = $request->long_description;
        $product->original_price = $request->original;
        $product->unit_price = $request->price;
        $product->promotion_price = $request->promotion;
        if($request->hasfile('img')){
            $product->image = $image;
        }
        if($images==[]){
            $images = $product->images;
            }
        $product->images = $images;
        $product->save();
        return $product;
    }

    public function getProductDelete($id){
        return Product::destroy($id);
    }

    public function getOn($id)
    {
        $on = Product::find($id);
        $on->status = Product::On_Product;
        $on->save();
        return json_encode((object)['on'=>$on]);
    }

    public function getOff($id)
    {
        $off = Product::find($id);
        $off->status = Product::Off_Product;
        $off->save();
        return json_encode((object)['off'=>$off]);
    }

    public function getOk($id)
    {
        $ok = Product::find($id);
        $ok->highlights = Product::Ok_Product;
        $ok->save();
        return json_encode((object)['ok'=>$ok]);
    }

    public function getNo($id)
    {
        $no = Product::find($id);
        $no->highlights = Product::No_Product;
        $no->save();
        return json_encode((object)['no'=>$no]);
    }

    //nhập số lượng
    // public function getEditQuantity($id)
    // {
    //     $quantity = Product::find($id);
    //     return response()->json(['data' => $quantity], 200);
    // }

    // public function postEditQuantity($request)
    // {
    //     $quantity = Product::find($request->id);
    //     $quantity->quantity += $request->quantity;
    //     $quantity->save();
    // }
}
