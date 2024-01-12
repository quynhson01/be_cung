<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PageRepository;
use App\Http\Requests\PageRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RatingRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    protected $repository;

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function gethome()
    {
        $slides = $this->repository->getSlide();
        $sale_banner = $this->repository->getSaleBanners();
        $brands = $this->repository->getBrands();
        $new_products = $this->repository->getNewProducts();
        $promotion_product = $this->repository->getPromotionProduct();
        $best_product = $this->repository->getBestProduct();
        $highlights_product = $this->repository->getHighLights();
        return view('page.pages.index', compact('slides', 'new_products', 'sale_banner', 'brands', 'promotion_product', 'best_product', 'highlights_product'));
    }

    public function getProductType(Request $request, $type)
    {
        $type_name = $this->repository->getTypename($type);
        $type_salebanners = $this->repository->getTypeSaleBanner($type);
        $type_products = $this->repository->getTypeProducts($request, $type);
        return view('page.pages.product_type', compact('type_name', 'type_products', 'type_salebanners'));
    }

    public function getSaleProduct(Request $request)
    {
        $promotion_product = $this->repository->getSaleProduct($request);
        $sale_banner = $this->repository->getSaleBanners();
        return view('page.pages.sale_product', compact('promotion_product', 'sale_banner'));
    }

    public function getProductDetail($id)
    {
        $product_detail = $this->repository->getProductDetail($id);
        $related_product = $this->repository->getProductRelated($id);
        $rating = $this->repository->getRating($id);
        $ratings = $this->repository->getRatings($id);
        $this->repository->ProductView($id);
        return view('page.pages.productdetail', compact('product_detail', 'related_product', 'rating', 'ratings'));
    }

    public function postRating($id, RatingRequest $request)
    {
        $this->repository->postRating($id, $request);
        return redirect()->back();
    }

    public function postLoginDetail(LoginRequest $request, $id)
    {
        $login_detail = array('email' => $request->email, 'password' => $request->password);
        $product = Product::find($id);
        if (Auth::attempt($login_detail)) {
            return redirect()->route('product_detail', $product);
        } else {
            return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }

    public function getProductBrands(Request $request, $id)
    {
        $name_brands = $this->repository->getNameBrands($id);
        $brands = $this->repository->getBrands();
        $product_brands = $this->repository->getProductBrands($request, $id);
        return view('page.pages.product_brands', compact('product_brands', 'brands', 'name_brands'));
    }
    public function getSearch(pageRequest $request)
    {
        $product_search = $this->repository->getSearch($request);
        return view('page.pages.search', compact('product_search'));
    }

    public function getAddToCart(Request $request, $id)
    {
        return $this->repository->getAddToCart($request, $id);
    }

    public function getDeleteCarts(Request $request, $id)
    {
        $size = $request->size;
        return $this->repository->getDeleteCarts($id, $size);
    }

    public function getShoppingCart()
    {
        return view('page.pages.cart');
    }

    public function postCart(Request $request)
    {
        return $this->repository->postCart($request);
    }

    public function getCheckout()
    {
        $cart = Session::get('cart');
        $product_name = '';
        $product_quantity = '';
        $status = 'true';
        if (isset($cart)) {
            foreach ($cart->items as $key => $value) {
                $product = Product::where('id', $key)
                    ->value('quantity');
                if ($value['qty'] > $product) {
                    $product_name = $value['item']['name'];
                    $product_quantity = $product;
                    $status = 'false';
                    break;
                }
            }
        }
        if ($status == 'true') {
            $user = Auth::user();
            return view('page.pages.checkout', compact('user'));
        } else {
            return back()->withErrors(['' . $product_name . ' chỉ còn lại ' . $product_quantity . ' sản phẩm']);
        }
    }

    public function postCheckout(CheckoutRequest $request)
    {
        $this->repository->postCheckout($request);
        return redirect()->back()->with('success', 'Đặt hàng thành công');
    }

    public function getRegister()
    {
        return view('page.pages.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $this->repository->postRegister($request);
        return redirect()->route('login')->with('success', 'Tạo tài khoản thành công. Mời đăng nhập');
    }

    public function getLogin()
    {
        return view('page.pages.login');
    }

    public function postLogin(LoginRequest $request)
    {
        return $this->repository->postLogin($request);
    }

    public function getLogout()
    {
        $this->repository->getLogout();
        return redirect()->route('home');
    }
}
