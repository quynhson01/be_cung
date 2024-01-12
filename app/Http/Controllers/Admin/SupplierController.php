<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SupplierRepository;
use App\Http\Requests\SupplierRequest;
use App\Http\Requests\SupplierEditRequest;

class SupplierController extends Controller
{
    protected $repository;

	public function __construct(SupplierRepository $repository){
		$this->repository = $repository;
	}

    public function getSupplierList(){
        $suppliers = $this->repository->getSuppliers();
        return view('admin.supplier.supplier_list',compact('suppliers'));
    }

    public function postSupplierAdd(SupplierRequest $request){
        $this->repository->postSupplierAdd($request);
        return redirect()->route('supplier_list')->with('success','Thêm thương hiệu thành công');
    }

    public function getSupplierEdit($id){
        return $this->repository->getSupplier($id);
    }

    public function postSupplierEdit(SupplierEditRequest $request){
        $this->repository->postSupplierEdit($request);
        return redirect()->route('supplier_list')->with('success','Cập nhật thương hiệu thành công');
    }

    public function getSupplierDelete($id){
        $this->repository->getSupplierDelete($id);
        return redirect()->route('supplier_list')->with('success','Xóa thương hiệu thành công');
    }
}
