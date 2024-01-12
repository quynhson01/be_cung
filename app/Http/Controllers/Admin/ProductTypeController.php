<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductTypeRepository;
use App\Http\Requests\ProductTypeRequest;
use App\Http\Requests\MenuRequest;
use App\Models\Fashion;
use App\Models\ProductType;

class ProductTypeController extends Controller
{
    protected $repository;

    public function __construct(ProductTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getProductTypeList()
    {
        $product_types = $this->repository->getProductTypeList();
        $menus = $this->repository->getFashions();
        return view('admin.producttype.producttype_list', compact('product_types','menus'));
    }

    public function postProductTypeList(ProductTypeRequest $request)
    {
        $this->repository->postProductTypeList($request);
        return redirect()->back()->with('success', 'Thêm loại sản phẩm thành công');
    }

    public function getProductTypeEdit($id)
    {
        return  $this->repository->getProductTypeEdit($id);
    }

    public function postProductTypeEdit(ProductTypeRequest $request)
    {
       $this->repository->postProductTypeEdit($request);
       return redirect()->back()->with('success', 'Cập nhật loại sản phẩm thành công');

    }
    public function getProductTypeDelete($id)
    {
        $product_type = $this->repository->getProductTypeDelete($id);
        if($product_type){
            ProductType::destroy($id);
            return redirect()->back()->with('success', 'Xóa loại sản phẩm thành công');
        }else{
            return redirect()->back()->with('error', 'Xóa loại sản phẩm thất bại! Sản phẩm vẫn còn');
        }


    }

    //Fashion
    public function postMenuAdd(MenuRequest $request)
    {
        $this->repository->postMenuAdd($request);
        return redirect()->back()->with('success1', 'Thêm danh mục thành công');
    }

    public function getMenuEdit($id)
    {
        return  $this->repository->getMenuEdit($id);
    }

    public function postMenuEdit(MenuRequest $request)
    {
       $this->repository->postMenuEdit($request);
       return redirect()->back()->with('success1', 'Cập nhật danh mục thành công');

    }

    public function OnCategory($id){
        return $this->repository->getOn($id);

    }

    public function OffCategory($id){
       return $this->repository->getOff($id);
    }

    public function getMenuDelete($id)
    {
        $category = $this->repository->getMenuDelete($id);
        if($category){
            Fashion::destroy($id);
            return redirect()->back()->with('success1', 'Xóa danh mục thành công');
        }else{
            return redirect()->back()->with('error1', 'Xóa danh mục thất bại! Loại sản phẩm vẫn còn');
        }
    }

}
