<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\OrderReceivedRepository;

class OrderReceivedController extends Controller
{
    protected $repository;

	public function __construct(OrderReceivedRepository $repository){
		$this->repository = $repository;
    }
    
    public function getOrder(){
        $orders = $this->repository->getOrder();
        return view('admin.order.order_received',compact('orders'));
    }

    public function postSearch(Request $request){
        $orders = $this->repository->getSearch($request);
        return view('admin.order.order_received',compact('orders'));
    }

    public function getMovedActive($id){
        $this->repository->getMovedActive($id);
        return redirect()->back()->with('success','đơn hàng đang được giao');
    }

    public function getCancelActive($id){
        $this->repository->getCancelActive($id);
        return redirect()->back()->with('success','đơn hàng đã bị hủy');
    }
}
