<?php

namespace App\Repositories;

use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function getInformation()
    {
        $user = Auth::user();
        return $user;
    }

    public function postInformation($request)
    {
        $user = Auth::user();
        if (isset($request->changeemail)) {
            $user->email = $request->email;
        }
        $user->full_name = $request->fullname;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();
        return $user;
    }

    public function postChangePassword($request)
    {
        if (Hash::check($request->oldpassword, Auth::user()->password)) {
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();
            return $user;
            return true;
        }
        return false;
        
    }

    public function getOrder()
    {
        $user_order = Auth::id();
        $orders = Bill::where('id_user', $user_order)->latest()->paginate(5);
        return $orders;
    }

    public function getBillDetail($id)
    {
        $bill_detail = Bill::find($id);
        return $bill_detail;
    }

    public function getBillDetails($id)
    {
        $bill_details = BillDetail::where('id_bill', $id)->get();
        return $bill_details;
    }
}
