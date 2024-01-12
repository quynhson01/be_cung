<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\OrderMovedRepository;

class OrderMovedController extends Controller
{
    protected $repository;

	public function __construct(OrderMovedRepository $repository){
		$this->repository = $repository;
    }
    
    public function getOrder(){
        $orders = $this->repository->getOrder();
        return view('admin.order.order_moved',compact('orders'));
    }

    public function postSearch(Request $request){
        $orders = $this->repository->getSearch($request);
        return view('admin.order.order_moved',compact('orders'));
    }

    public function getCompleteActive($id){
        $this->repository->getCompleteActive($id);
        return redirect()->back()->with('success','đơn hàng đã được giao');
    }

    public function getCancelActive($id){
        $this->repository->getCancelActive($id);
        return redirect()->back()->with('success','đơn hàng đã bị hủy');
    }
}
