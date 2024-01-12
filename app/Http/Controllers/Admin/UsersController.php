<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $repository;

	public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;   
    }

    public function getUsers(){
        $users = $this->repository->getUsers();
        return view('admin.users.users',compact('users'));
    }

    public function postSearchUser(Request $request)
    {
        $users = $this->repository->postSearchUser($request);
        return view('admin.users.users', compact('users'));
    }

    public function getAdminActive($id){
        $this->repository->getAdminActive($id);
        return redirect()->back()->with('success','Đã trở thành quản trị viên');
    }

    public function getUserActive($id){
        $this->repository->getUserActive($id);
        return redirect()->back()->with('success','Đã trở thành thành khách hàng');
    }

    public function getUserDelete($id){
        $this->repository->getUserDelete($id);
        return redirect()->back()->with('success','Xóa thành viên thành công');
    }
}
