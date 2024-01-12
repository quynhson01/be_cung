<?php

namespace App\Repositories;

use App\Models\Fashion;
use App\Models\ProductType;

class ProductTypeRepository
{
    public function getProductTypeList()
    {
        return ProductType::orderBy('id', 'desc')->get();

    }

    public function getFashions()
    {
        return Fashion::orderBy('id', 'desc')->get();
    }

    public function postProductTypeList($request)
    {
        // $type = new ProductType;
        // $type->name = $request->name;
        // $type->fashion = $request->fashion;
        // $type->save();
        // return response()->json([
        //     'data' => $type,
        //     'message' => 'Tạo sinh viên thành công'
        // ], 200); // 200 là mã lỗi

        $type = new ProductType();
        $type->id_fashion = $request->fashion;
        $type->name = $request->name;
        $type->save();
        return $type;
    }

    public function getProductTypeEdit($id)
    {
        $product_type = ProductType::find($id);
        return response()->json(['data' => $product_type], 200);
    }

    public function postProductTypeEdit($request)
    {
        $type = ProductType::find($request->id);
        $type->id_fashion = $request->fashion;
        $type->name = $request->name;
        $type->save();
    }
    public function getProductTypeDelete($id)
    {
        // ProductType::find($id)->delete();
        // return response()->json(['data'=>'removed'],200);
        $product_type = ProductType::find($id);
        $types = $product_type->products;
        $product_types = count($types);
        if($product_types == 0){
            return true;
        }else{
            return false;
        }
    }

    //Fashion
    //Fashion->getall
    public function postMenuAdd($request)
    {
        $menu = new Fashion();
        $menu->name = $request->name;
        $menu->save();
        return $menu;
    }

    public function getMenuEdit($id)
    {
        $menu = Fashion::find($id);
        return response()->json(['data' => $menu], 200);
    }

    public function postMenuEdit($request)
    {
        $menu = Fashion::find($request->id);
        $menu->name = $request->name;
        $menu->save();
        return $menu;
    }

    public function getOn($id)
    {
        $on = Fashion::find($id);
        $on->status = Fashion::On_Cate;
        $on->save();
        return json_encode((object)['on'=>$on]);
    }

    public function getOff($id)
    {
        $off = Fashion::find($id);
        $off->status = Fashion::Off_Cate;
        $off->save();
        return json_encode((object)['off'=>$off]);
    }

    public function getMenuDelete($id)
    {
        $cate_count = Fashion::find($id);
        $cates = $cate_count->productType;
        $category = count($cates);
        if($category == 0){
            return true;
        }else{
            return false;
        }
    }
}
