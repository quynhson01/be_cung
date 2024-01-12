<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductEditRequest;
use App\Http\Requests\ProductQuantityRequest;

class ProductController extends Controller
{
	protected $repository;

	public function __construct(ProductRepository $repository){
		$this->repository = $repository;
	}

    public function getProductList(){
        $products = $this->repository->getProducts();
        return view('admin.product.product_list',compact('products'));
    }

    public function getProductAdd(){
        $product_type = $this->repository->getProductType();
        $brands = $this->repository->getBrands();
        return view('admin.product.product_add',compact('product_type','brands'));
    }

    public function postProductAdd(ProductAddRequest $request){
        $this->repository->postProductAdd($request);
        return redirect()->route('product_list')->with('success','Thêm sản phẩm thành công');
    }

    public function getProductEdit($id){
        $product = $this->repository->getProduct($id);
        $product_type = $this->repository->getProductType();
        $brands = $this->repository->getBrands();
        return view('admin.product.product_edit',compact('product_type','product','brands'));
    }

    public function postProductEdit(ProductEditRequest $request, $id){
        $this->repository->postProductEdit($request,$id);
        return redirect()->route('product_list')->with('success','Cập nhật sản phẩm thành công');
    }

    public function getProductDelete($id){
        $this->repository->getProductDelete($id);
        return redirect()->route('product_list')->with('success','Xóa sản phẩm thành công');
    }

    public function OnProduct($id){
        return $this->repository->getOn($id);
        // return redirect()->back()->with('success','Sản phẩm đã được hiển thị');
    }

    public function OffProduct($id){
        return $this->repository->getOff($id);
        // return redirect()->back()->with('success','Sản phẩm đã dừng hiển thị');
    }

    public function OkProduct($id){
        return $this->repository->getOk($id);
        // return redirect()->back()->with('success','Sản phẩm đã nổi bật');
    }

    public function NoProduct($id){
        return $this->repository->getNo($id);
        // return redirect()->back()->with('success','Sản phẩm không nổi bật');
    }

    //số lượng

    // public function getEditQuantity($id)
    // {
    //     return  $this->repository->getEditQuantity($id);
    // }

    // public function postEditQuantity(ProductQuantityRequest $request)
    // {
    //    $this->repository->postEditQuantity($request);
    //    return redirect()->back()->with('success', 'Thêm số lượng sản phẩm thành công');
        
    // }
}
