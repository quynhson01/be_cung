<?php

namespace App\Repositories;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Cart;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Rating;
use App\Models\Slide;
use App\Models\SaleBanner;
use App\Models\Size;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PageRepository
{
    //trang chu
    public function getSlide()
    {
        return Slide::where('status', 1)->latest()->limit(5)->get();
    }

    public function getSaleBanners()
    {
        return SaleBanner::where('status', 1)->latest()->limit(3)->get();
    }

    public function getBrands()
    {
        return Supplier::all();
    }

    public function getNewProducts()
    {
        return Product::where('status', 1)->latest()->limit(10)->get();
    }

    public function getPromotionProduct()
    {
        return Product::where('promotion_price', '<>', 0)->where('status', 1)->latest()->limit(10)->get();
    }

    public function getHighLights()
    {
        return Product::where(['highlights' => 1, 'status' => 1])->latest()->limit(10)->get();
    }

    public function getBestProduct()
    {
        return Product::orderBy('sold_quantity', 'desc')->where('status', 1)->limit(10)->get();
    }

    //loại sản phẩm

    //->getSaleBanners

    public function getTypeName($type)
    {
        return ProductType::find($type);
    }

    public function getTypeSaleBanner($type)
    {
        return SaleBanner::where(['id_type' => $type, 'status' => 1])->limit(3)->get();
    }

    public function getTypeProducts($request, $type)
    {
        $type_products = Product::where(['id_type' => $type, 'status' => 1]);
        if ($request->price) {
            $price = $request->price;
            switch ($price) {
                case '1':
                    $type_products->where('unit_price', '<', 200000);
                    break;
                case '2':
                    $type_products->whereBetween('unit_price', [200000, 400000]);
                    break;
                case '3':
                    $type_products->whereBetween('unit_price', [400000, 600000]);
                    break;
                case '4':
                    $type_products->whereBetween('unit_price', [600000, 800000]);
                    break;
                case '5':
                    $type_products->whereBetween('unit_price', [800000, 1000000]);
                    break;
                case '6':
                    $type_products->whereBetween('unit_price', [1000000, 1500000]);
                    break;
                case '7':
                    $type_products->whereBetween('unit_price', [1500000, 2000000]);
                    break;
                case '8':
                    $type_products->where('unit_price', '>', 2000000);
                    break;
            }
        }

        if ($request->orderby) {
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'new':
                    $type_products->orderBy('id', 'desc');
                    break;
                case 'hot':
                    $type_products->where('highlights', 1);
                    break;
                case 'promotion':
                    $type_products->where('promotion_price', '<>', 0)->orderBy('promotion_price','asc');
                    break;
                case 'min':
                    $type_products->orderBy('unit_price', 'desc');
                    break;
                case 'max':
                    $type_products->orderBy('unit_price', 'asc');
                    break;
                default:
                    $type_products->orderBy('id', 'desc');
            }
        }
        $type_products = $type_products->paginate(12);
        return $type_products;
    }

    //chi tiết sản phẩm
    public function getProductDetail($id)
    {
        $product_detail = Product::find($id);
        return $product_detail;
    }

    public function getProductRelated($id)
    {
        $product_detail = Product::find($id);
        $related_product = Product::where(['id_type' => $product_detail->id_type, 'status' => 1])->get();
        return $related_product;
    }

    public function getRating($id)
    {
        return Rating::where('id_product', $id)->latest()->paginate(10);
    }

    public function getRatings($id)
    {
        $user = Auth::id();
        $rating_user = Rating::where(['id_product' => $id, 'id_user' => $user])->first();
        $product =  Product::find($id);
        return ['product' => $product, 'rating_user' => $rating_user];
    }

    public function postRating($id, $request)
    {
        $rating = new Rating();
        $rating->id_product = $id;
        $rating->id_user = Auth::user()->id;
        $rating->stars = $request->rating;
        $rating->content = $request->content;
        $rating->save();

        $product = Product::find($id);
        $product->total_number += $request->rating;
        $product->total_ra += 1;
        $product->save();
    }

    public function ProductView($id)
    {
        $product = Product::where('id',$id)->first();
        $product->product_views = $product->product_views + 1;
        $product->save();
    }
    //Sản phẩm theo thương hiệu
    //->getBrands
    public function getNameBrands($id)
    {
        return Supplier::find($id);
    }

    public function getProductBrands($request, $id)
    {
        $product_brands = Product::where('id_supplier', $id);
        if ($request->price) {
            $price = $request->price;
            switch ($price) {
                case '1':
                    $product_brands->where('unit_price', '<', 200000);
                    break;
                case '2':
                    $product_brands->whereBetween('unit_price', [200000, 400000]);
                    break;
                case '3':
                    $product_brands->whereBetween('unit_price', [400000, 600000]);
                    break;
                case '4':
                    $product_brands->whereBetween('unit_price', [600000, 800000]);
                    break;
                case '5':
                    $product_brands->whereBetween('unit_price', [800000, 1000000]);
                    break;
                case '6':
                    $product_brands->whereBetween('unit_price', [1000000, 1500000]);
                    break;
                case '7':
                    $product_brands->whereBetween('unit_price', [1500000, 2000000]);
                    break;
                case '8':
                    $product_brands->where('unit_price', '>', 2000000);
                    break;
            }

        }

        if ($request->orderby) {
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'new':
                    $product_brands->orderBy('id', 'desc');
                    break;
                case 'hot':
                    $product_brands->where('highlights', 1);
                    break;
                case 'promotion':
                    $product_brands->where('promotion_price', '<>', 0)->orderBy('promotion_price','asc');
                    break;
                case 'min':
                    $product_brands->orderBy('unit_price', 'desc');
                    break;
                case 'max':
                    $product_brands->orderBy('unit_price', 'asc');
                    break;
                default:
                    $product_brands->orderBy('id', 'desc');
            }
        }
        $product_brands = $product_brands->paginate(12);
        return $product_brands;
    }

    //sản phẩm khuyến mãi
    public function getSaleProduct($request)
    {
        $product_sales = Product::where('promotion_price', '<>', 0)->where('status', 1);
        if ($request->price) {
            $price = $request->price;
            switch ($price) {
                case '1':
                    $product_sales->where('unit_price', '<', 200000);
                    break;
                case '2':
                    $product_sales->whereBetween('promotion_price', [200000, 400000]);
                    break;
                case '3':
                    $product_sales->whereBetween('promotion_price', [400000, 600000]);
                    break;
                case '4':
                    $product_sales->whereBetween('promotion_price', [600000, 800000]);
                    break;
                case '5':
                    $product_sales->whereBetween('promotion_price', [800000, 1000000]);
                    break;
                case '6':
                    $product_sales->whereBetween('promotion_price', [1000000, 1500000]);
                    break;
                case '7':
                    $product_sales->whereBetween('promotion_price', [1500000, 2000000]);
                    break;
                case '8':
                    $product_sales->where('promotion_price', '>', 2000000);
                    break;
            }

        }

        if ($request->orderby) {
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'new':
                    $product_sales->orderBy('id', 'desc');
                    break;
                case 'hot':
                    $product_sales->where('highlights', 1);
                    break;
                case 'min':
                    $product_sales->orderBy('promotion_price', 'desc');
                    break;
                case 'max':
                    $product_sales->orderBy('promotion_price', 'asc');
                    break;
                default:
                    $product_sales->orderBy('id', 'desc');
            }
        }
        $product_sales =$product_sales->paginate(12);
        return $product_sales;
    }
    //
    public function getSearch($request)
    {
        $product_search = Product::where('status', 1)->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('unit_price', $request->search)
            ->orWhere('promotion_price', $request->search)
            ->paginate(12);
        return $product_search;
    }
    //
    //
    public function getAddToCart($request, $id)
    {
        $product_cart = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $size = Size::find($request->id_size);
        $size_name = $size->size;
        $cart = new Cart($oldCart);
        $cart->add($product_cart, $id, $request->id_size, $size_name);
        $request->Session()->put('cart', $cart);
        return response()->json(array('totalQty' => $cart->totalQty, 'totalPrice' => $cart->totalPrice));
    }

    public function getDeleteCarts($id, $size)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id, $size);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'cart' => $cart,
        ], 200);
    }

    public function postCart($request)
    {
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->changeItem($request->id, $request->quantity);
        $request->session()->put('cart', $cart);
        return response()->json(array('cart' => $cart, 'id' => $request->id));
    }
    //
    public function getAuth()
    {
        return Auth::user();
    }
    public function postCheckout($request)
    {
        $cart = Session::get('cart');
        $user = Auth::user();

        $bill = new Bill();
        $bill->id_user = $user->id;
        $bill->name = $request->fullname;
        $bill->gender = $request->gender;
        $bill->email = $request->email;
        $bill->address = $request->address;
        $bill->phone_number = $request->phone;
        $bill->quantity = $cart->totalQty;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        foreach ($cart->items as $key => $value) {
            $bill->total_profit += (($value['price'])-($value['item']['original_price']*$value['qty']));
        }
        $bill->payment = $request->payment;
        $bill->note = $request->note;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $product = Product::find($value['id_product']);
            $product->quantity -= $value['qty'];
            $product->sold_quantity += $value['qty'];
            $product->save();

            $size = Size::find($value['id_size']);
            $size->quantity -= $value['qty'];
            $size->sold_quantity += $value['qty'];
            $size->save();

            $bill_detail = new BillDetail();
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $value['id_product'];
            $bill_detail->id_size = $value['id_size'];
            $bill_detail->quantity = $value['qty'];
            $bill_detail->size = $value['size_name'];
            $bill_detail->unit_price = $value['price'] / $value['qty'];
            $bill_detail->save();
        }
        Session::forget('cart');
    }
    //
    public function postRegister($request)
    {
        $user = new User();
        $user->full_name = $request->fullname;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success', 'Tạo tài khoản thành công');
    }

    public function postLogin($request)
    {
        $admin_array = array('email' => $request->email, 'password' => $request->password, 'level' => 1);
        $user_array = array('email' => $request->email, 'password' => $request->password, 'level' => 0);
        if (Auth::attempt($admin_array)) {
            return redirect()->route('admin_index');
        } else if (Auth::attempt($user_array)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('error', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }

    public function getlogout()
    {
        $logout = Auth::logout();
        return $logout;
    }
}
