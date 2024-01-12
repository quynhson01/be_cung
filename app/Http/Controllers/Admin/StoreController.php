<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\StoreRepository;
use App\Http\Requests\ProductQuantityRequest;
use App\Http\Requests\SizeRequest;
use App\Models\Product;
use App\Models\Size;

class StoreController extends Controller
{
	protected $repository;

	public function __construct(StoreRepository $repository){
		$this->repository = $repository;
	}

    public function getStore(){
        $stores = $this->repository->getStores();
        return view('admin.store.store',compact('stores'));
    }
    //số lượng

    public function getAddSize($id)
    {
        return $this->repository->getAddSize($id);
    }

    public function postAddSize(SizeRequest $request)
    {
       $this->repository->postAddSize($request);
       return redirect()->back()->with('success', 'Thêm kích thước thành công');
        
    }

    public function getAddStore($id){
        $sizes = Size::where('id_product',$id)->get();
        if(count($sizes) <= 0){
            return redirect()->back()->with('danger', 'Sản phẩm chưa có kích thước. mời bạn nhập kích thước');
        }else{
            return view('admin.store.store_input',compact('sizes'));
        }
        
    }

    public function getAddQuantity($id)
    {
        return $this->repository->getAddQuantity($id);
    }

    public function postAddQuantity(ProductQuantityRequest $request)
    {
       $this->repository->postAddQuantity($request);
       return redirect()->back()->with('success', 'Thêm số lượng sản phẩm thành công'); 
    }

    public function getEditSize($id)
    {
        return  $this->repository->getEditSize($id);
    }

    public function postEditSize(SizeRequest $request)
    {
       $this->repository->postEditSize($request);
       return redirect()->back()->with('success', 'Cập nhật kích thước thành công');
        
    }

    public function getDeleteSize($id)
    {
       $this->repository->getDeleteSize($id);
       return redirect()->back()->with('success', 'Xóa kích thước thành công');
        
    }
}