<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use App\Repositories\OrderCompleteRepository;

class OrderCompleteController extends Controller
{
    protected $repository;

	public function __construct(OrderCompleteRepository $repository){
		$this->repository = $repository;
    }

    public function getOrder(){
        $orders = $this->repository->getOrder();
        return view('admin.order.order_complete',compact('orders'));
    }

    public function postSearch(Request $request){
        $orders = $this->repository->getSearch($request);
        return view('admin.order.order_complete',compact('orders'));
    }

    public function getDelete($id){
        $this->repository->getDelete($id);
        return redirect()->back()->with('success','Xóa đơn hàng thành công');
    }
    // public function getOrderDetail(Request $request, $id){
    //     if($request->ajax()){
    //         $order_detail = BillDetail::where('id_bill',$id)->get();
    //         $total = Bill::find($id);
    //         $html = view('admin.order.order_detail',compact('order_detail','total'))->render();
    //         return response()->json($html);
    //     }
    // }
}
