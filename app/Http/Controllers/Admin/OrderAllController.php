<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;
use App\Repositories\OrderAllRepository;

class OrderAllController extends Controller
{
    protected $repository;

	public function __construct(OrderAllRepository $repository){
		$this->repository = $repository;
    }
    
    public function getOrder(){
        $orders = $this->repository->getOrder();
        return view('admin.order.order_all',compact('orders'));
    }

    public function getReceivedActiveNone($id){
        $this->repository->getReceivedActiveNone($id);
        return redirect()->back()->with('success','đơn hàng đang ở trang thái tiếp nhận');
    }

    public function getReceivedActive($id){
        $this->repository->getReceivedActive($id);
        return redirect()->back()->with('success','đơn hàng đang ở trang thái tiếp nhận');
    }

    public function getMovedActiveNone($id){
        $this->repository->getMovedActiveNone($id);
        return redirect()->back()->with('success','đơn hàng đang được giao');
    }

    public function getMovedActive($id){
        $this->repository->getMovedActive($id);
        return redirect()->back()->with('success','đơn hàng đang được giao');
    }

    public function getCompleteActiveNone($id){
        $this->repository->getCompleteActiveNone($id);
        return redirect()->back()->with('success','đơn hàng đã được giao');
    }

    public function getCompleteActive($id){
        $this->repository->getCompleteActive($id);
        return redirect()->back()->with('success','đơn hàng đã được giao');
    }

    public function getCancelActiveNone($id){
        $this->repository->getCancelActiveNone($id);
        return redirect()->back()->with('success','đơn hàng đã bị thất bại');
    }

    public function getCancelActive($id){
        $this->repository->getCancelActive($id);
        return redirect()->back()->with('success','đơn hàng đã bị thất bại');
    }

    public function postSearch(Request $request){
        $orders = $this->repository->getSearch($request);
        return view('admin.order.order_all',compact('orders'));
    }

    public function getDelete($id){
        $this->repository->getDelete($id);
        return redirect()->back()->with('success','Xóa đơn hàng thành công');
    }
}
