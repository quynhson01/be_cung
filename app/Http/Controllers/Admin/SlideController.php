<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SlideRepository;
use App\Http\Requests\SlideAddRequest;
use App\Http\Requests\SlideEditRequest;

class SlideController extends Controller
{
    protected $repository;

	public function __construct(SlideRepository $repository)
    {
        $this->repository = $repository;   
    }

    public function getSlideList(){
        $slides = $this->repository->getSlides();
        return view('admin.slide.slide_list',compact('slides'));
    }

    public function postSlideAdd(SlideAddRequest $request){
        $this->repository->postSlideAdd($request);
        return redirect()->route('slide_list')->with('success','Thêm ảnh bìa thành công');
    }

    public function getSlideEdit($id){
        return $this->repository->getSlide($id);
    }

    public function postSlideEdit(SlideEditRequest $request){
        $this->repository->postSlideEdit($request);
        return redirect()->back()->with('success','Cập nhật ảnh bìa thành công');
    }

    public function getOn($id){
        $this->repository->getOn($id);
        return redirect()->back()->with('success','Ảnh bìa đã được hiển thị');
    }

    public function getOff($id){
        $this->repository->getOff($id);
        return redirect()->back()->with('success','Ảnh bìa Không được hiển thị');
    }

    public function getSlideDelete($id){
        $slide = $this->repository->getSlideDelete($id);
        return redirect()->route('slide_list')->with('success','Xóa Ảnh bìa thành công');
    }
}
