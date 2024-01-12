<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use App\Repositories\OrderCancelRepository;

class OrderCancelController extends Controller
{
    protected $repository;

	public function __construct(OrderCancelRepository $repository){
		$this->repository = $repository;
    }
    
    public function getOrder(){
        $orders = $this->repository->getOrder();
        return view('admin.order.order_cancel',compact('orders'));
    }

    public function postSearch(Request $request){
        $orders = $this->repository->getSearch($request);
        return view('admin.order.order_cancel',compact('orders'));
    }

    public function getDelete($id){
        $this->repository->getDelete($id);
        return redirect()->back()->with('success','Xóa đơn hàng thành công');
    }
}
