<?php

namespace App\Providers;

use App\Models\Bill;
use App\Models\Cart;
use App\Models\Fashion;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('page.layout.header', function ($view) {
            $menus = Fashion::where('status',1)->limit(5)->get();
            $view->with('menus',$menus);
        });

        view()->composer('page.layout.footer', function ($view) {
            $menu_f = Fashion::limit(6)->get();
            $view->with('menu_f',$menu_f);
        });

        view()->composer(['header','page.pages.cart'],function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items, 'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            } 
        });

        view()->composer(['header','page.pages.checkout'],function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'), 'product_cart'=>$cart->items, 'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            } 
        });
        
        view()->composer('page.layout.header', function ($view) {
            if (Session('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);

                $view->with([
                    'cart' => Session::get('cart'),
                    'product_cart' => $cart->items, 
                    'totalPrice' => $cart->totalPrice, 
                    'totalQty' => $cart->totalQty
                ]);
            }
        });

        view()->composer('admin.layout.master',function($view){
            $received_order = Bill::where('status',0)->get();
            $moved_order = Bill::where('status',1)->get();
            $complete_order = Bill::where('status',2)->get();
            $view->with(['received_order'=>$received_order, 'moved_order'=>$moved_order, 'complete_order'=>$complete_order]);
        });
    }
}
