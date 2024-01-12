<?php

namespace App\Repositories;

use App\Models\Bill;
use App\Models\Product;
use App\Models\User;

class AdminRepository
{
    public function getProducts(){
        return Product::all();
    }

    public function getOrders(){
        return Bill::all();
    }

    public function getUsers(){
        return User::all();
    }

    public function getTotalRevenue($request)
    {
        return Bill::where('status',2)->whereBetween('date_order', [$request->from, $request->to])->sum('total');
    }
    public function getrevenueProfit($request)
    {
        return Bill::where('status',2)->whereBetween('date_order', [$request->from, $request->to])->sum('total_profit');
    }
}
