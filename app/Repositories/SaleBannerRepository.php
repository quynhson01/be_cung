<?php

namespace App\Repositories;

use App\Models\Fashion;
use App\Models\ProductType;
use App\Models\SaleBanner;

class SaleBannerRepository
{

    public function getSaleBanners()
    {
        return SaleBanner::all();
    }

    public function getProductTypes()
    {
        return ProductType::all();
    }

    public function postSaleBannerAdd($request)
    {
        $name = '';
        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('frontend\image\sale_banner'); //project\public\images\cars, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images
        }

        $sale_banner = new SaleBanner();
        $sale_banner->id_type = $request->type;
        $sale_banner->image = $name;
        $sale_banner->save();
        return $sale_banner;
    }

    public function getSaleBanner($id)
    {
        $sale_banner = SaleBanner::find($id);
        return response()->json(['data' => $sale_banner], 200);
    }

    public function postSaleBannerEdit($request)
    {
        $name = '';
        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('frontend\image\sale_banner'); //project\public\images\cars, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images
        }

        $sale_banner = SaleBanner::find($request->id);
        $sale_banner->id_type = $request->type;
        if($request->hasfile('img')){
            $sale_banner->image = $name;
        }
        $sale_banner->save();
    }

    public function getOn($id)
    {
        $on = SaleBanner::find($id);
        $on->status = SaleBanner::Status_On;
        $on->save();
        return $on;
    }

    public function getOff($id)
    {
        $off = SaleBanner::find($id);
        $off->status = SaleBanner::Status_Off;
        $off->save();
        return $off;
    }

    public function getSaleBannerDelete($id)
    {
        $sale_banner = SaleBanner::destroy($id);
        return $sale_banner;
    }
}
