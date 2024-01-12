<?php

namespace App\Repositories;

use App\Models\Slide;

class SlideRepository
{

    public function getSlides()
    {
        $slides = Slide::all();
        return $slides;
    }

    public function postSlideAdd($request)
    {
        $name = '';
        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('frontend\image\slide'); //project\public\images\cars, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images
        }

        $slide = new Slide();
        $slide->image = $name;
        $slide->save();
        return $slide;
    }

    public function getSlide($id)
    {
        $sale_banner = Slide::find($id);
        return response()->json(['data' => $sale_banner], 200);
    }

    public function postSlideEdit($request)
    {
            $name = '';
            if ($request->hasfile('img')) {
                $file = $request->file('img');
                $name = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('frontend\image\slide'); //project\public\images\cars, //public_path(): trả về đường dẫn tới thư mục public
                $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images
            }

            $slide = Slide::find($request->id);
            if ($request->hasfile('img')) {
                $slide->image = $name;
            }
            $slide->save();
    }

    public function getOn($id)
    {
        $on = Slide::find($id);
        $on->status = Slide::Status_On;
        $on->save();
        return $on;
    }

    public function getOff($id)
    {
        $off = Slide::find($id);
        $off->status = Slide::Status_Off;
        $off->save();
        return $off;
    }

    public function getSlideDelete($id)
    {
        $slide = Slide::destroy($id);
        return $slide;
    }
}
