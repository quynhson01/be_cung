<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\InformationRequest;
use App\Models\Bill;
use App\Models\BillDetail;

class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository){
        $this->repository = $repository;
    }

    public function getInformation(){
        $user = $this->repository->getInformation();
        return view('page.user.information',compact('user'));
    }

    public function postInformation(InformationRequest $request){ 
        $this->repository->postInformation($request);
        return redirect()->back()->with('success','Cập nhật thông tin thành công');
    }

    public function getChangePassword(){
        return view('page.user.changepassword');
    }

    public function postChangePassword(ChangePasswordRequest $request){
       $chang_password = $this->repository->postChangePassword($request);
       if($chang_password){
        $chang_password;
        return redirect()->back()->with(['flag'=>'success','message'=>'Đổi mật khẩu thành công']);
       }
        return redirect()->back()->with(['flag'=>'danger','message'=>'Mật khẩu cũ không đúng']);
    }

    public function getOrder(){
        $orders = $this->repository->getOrder();
        return view('page.user.order',compact('orders'));
    }

    public function getOrderDetail(Request $request, $id){
        if($request->ajax()){
            $order_detail = BillDetail::where('id_bill',$id)->get();
            $total = Bill::find($id);
            $html = view('page.user.order_detail',compact('order_detail','total'))->render();
            return response()->json($html);
        }
    }
}
