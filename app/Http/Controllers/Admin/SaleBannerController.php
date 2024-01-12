<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SaleBannerRepository;
use App\Http\Requests\SaleBannerAddRequest;
use App\Http\Requests\SaleBannerEditRequest;

class SaleBannerController extends Controller
{
    protected $repository;

	public function __construct(SaleBannerRepository $repository)
    {
        $this->repository = $repository;   
    }

    public function getSaleBannerList(){
        $sale_banners = $this->repository->getSaleBanners();
        $types = $this->repository->getProductTypes();
        return view('admin.sale_banner.salebanner_list',compact('sale_banners','types'));
    }

    public function postSaleBannerAdd(SaleBannerAddRequest $request){
        $this->repository->postSaleBannerAdd($request);
        return redirect()->route('salebanner_list')->with('success','Thêm ảnh giảm giá thành công');
    }

    public function getSaleBannerEdit($id){
        return $this->repository->getSaleBanner($id);
    }

    public function postSaleBannerEdit(SaleBannerEditRequest $request){
        $this->repository->postSaleBannerEdit($request);
        return redirect()->route('salebanner_list')->with('success','Cập nhật ảnh giảm giá thành công');
    }

    public function getOn($id){
        $this->repository->getOn($id);
        return redirect()->back()->with('success','Hình ảnh đã được hiển thị');
    }

    public function getOff($id){
        $this->repository->getOff($id);
        return redirect()->back()->with('success','Hình ảnh Không được hiển thị');
    }

    public function getSaleBannerDelete($id){
        $slide = $this->repository->getSaleBannerDelete($id);
        return redirect()->route('salebanner_list')->with('success','Xóa ảnh giảm giá thành công');
    }
}
