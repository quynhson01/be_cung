<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersRepository
{
    public function getUsers(){
        return User::orderBy('id','desc')->paginate(10);
    }

    public function postSearchUser($request)
    {
        $user_search = User::where('full_name', 'like', '%' . $request->search . '%')
            ->orWhere('email', $request->search)
            ->orWhere('address', $request->search)
            ->orWhere('id', $request->search)
            ->orWhere('phone', $request->search)
            ->paginate(10);
        return $user_search;
    }

    public function getAdminActive($id){
        $admin = User::find($id);
        $admin->level = User::Admin_active;
        $admin->save();
    }

    public function getUserActive($id){
        $user = User::find($id);
        $user->level = User::User_active;
        $user->save();
    }

    public function getUserDelete($id){
        return User::find($id);
    }
}
