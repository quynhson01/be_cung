<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\Page\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\SaleBannerController;
use App\Http\Controllers\Admin\OrderReceivedController;
use App\Http\Controllers\Admin\OrderMovedController;
use App\Http\Controllers\Admin\OrderCompleteController;
use App\Http\Controllers\Admin\OrderCancelController;
use App\Http\Controllers\Admin\OrderAllController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
// 	return view('welcome');
// });
Route::prefix('/')->group(function () {
	Route::get('/', [PageController::class, 'getHome'])->name('home');
	Route::get('all-by-category/{id}', [PageController::class, 'getCategoryAll'])->name('category_all');
	Route::get('product-detail/{id}', [PageController::class, 'getProductDetail'])->name('product_detail');
	Route::post('product-detail/{id}', [PageController::class, 'postRating'])->name('rating');
	Route::post('login-detail/{id}', [PageController::class, 'postLoginDetail'])->name('login_detail');
	Route::get('product-type/{type}', [PageController::class, 'getProductType'])->name('product_type');
	Route::get('product-brands/{id}', [PageController::class, 'getProductBrands'])->name('product_brands');
	Route::get('sale-product', [PageController::class, 'getSaleProduct'])->name('sale_product');
	Route::get('add-to-cart/{id}', [PageController::class, 'getAddToCart'])->name('add_to_cart');
	Route::get('delete-carts/{id}', [PageController::class, 'getDeleteCarts'])->name('delete_carts');
	Route::get('search', [PageController::class, 'getSearch'])->name('search');

	Route::get('shopping-cart', [PageController::class, 'getShoppingCart'])->name('shopping_cart');
	Route::post('shopping-cart', [PageController::class, 'postCart'])->name('cart');
	Route::middleware(['CheckLogout'])->group(function () {

		Route::get('checkout', [PageController::class, 'getCheckout'])->name('checkout');
		Route::post('checkout', [PageController::class, 'postCheckout'])->name('checkout');

		Route::prefix('account')->group(function () {
			Route::get('information', [UserController::class, 'getInformation'])->name('information');
			Route::post('information', [UserController::class, 'postInformation'])->name('information');

			Route::get('change-password', [UserController::class, 'getChangePassword'])->name('change_password');
			Route::post('change-password', [UserController::class, 'postChangePassword'])->name('change_password');

			Route::prefix('order')->group(function () {
				Route::get('/', [UserController::class, 'getOrder'])->name('order');
				Route::get('order-detail/{id}', [UserController::class, 'getOrderDetail'])->name('orderdetail_user');
			});
		});
	});

	Route::middleware(['CheckLogin'])->group(function () {
		Route::get('login', [PageController::class, 'getLogin'])->name('login');
		Route::post('login', [PageController::class, 'postLogin'])->name('login');

		Route::get('reset-password', [ForgotPasswordController::class, 'getResetPassword'])->name('reset_password');
		Route::post('reset-password', [ForgotPasswordController::class, 'postResetPassword'])->name('reset_password');

		Route::get('password-reset', [ForgotPasswordController::class, 'getPasswordReset'])->name('link_password_reset');
		Route::post('password-reset', [ForgotPasswordController::class, 'postPasswordReset'])->name('update_password_reset');

	});

	Route::get('logout', [PageController::class, 'getLogout'])->name('logout');

	Route::get('register', [PageController::class, 'getRegister'])->name('register');
	Route::post('register', [PageController::class, 'postRegister'])->name('register');
});

//quản trị
Route::middleware(['CheckAdminLogin'])->group(function () {
	Route::prefix('admin')->group(function () {
		Route::get('home', [AdminController::class, 'getAdmin'])->name('admin_index');
		Route::post('home', [AdminController::class, 'getAdmin'])->name('admin_index');

		Route::prefix('product-type')->group(function () {
			Route::get('/', [ProductTypeController::class, 'getProductTypeList'])->name('producttype_list');
			Route::post('/', [ProductTypeController::class, 'postProductTypeList'])->name('producttype_list');

			Route::get('edit/{id}', [ProductTypeController::class, 'getProductTypeEdit'])->name('producttype_edit');
			Route::post('edit', [ProductTypeController::class, 'postProductTypeEdit'])->name('producttype_update');

			Route::get('delete/{id}', [ProductTypeController::class, 'getProductTypeDelete'])->name('producttype_delete');

			Route::post('add', [ProductTypeController::class, 'postMenuAdd'])->name('menu_add');

			Route::get('category-edit/{id}', [ProductTypeController::class, 'getMenuEdit'])->name('menu_edit');
			Route::post('category-edit', [ProductTypeController::class, 'postMenuEdit'])->name('menu_update');

			Route::get('on/{id}', [ProductTypeController::class, 'OnCategory'])->name('on_category');
			Route::get('off/{id}', [ProductTypeController::class, 'OffCategory'])->name('off_category');

			Route::get('menu-delete/{id}', [ProductTypeController::class, 'getMenuDelete'])->name('menu_delete');
		});

		Route::prefix('products')->group(function () {
			Route::get('/', [ProductController::class, 'getProductList'])->name('product_list');

			Route::get('add', [ProductController::class, 'getProductAdd'])->name('product_add');
			Route::post('add', [ProductController::class, 'postProductAdd'])->name('product_add');

			Route::get('edit/{id}', [ProductController::class, 'getProductEdit'])->name('product_edit');
			Route::post('edit/{id}', [ProductController::class, 'postProductEdit'])->name('product_edit');

			Route::get('on/{id}', [ProductController::class, 'OnProduct'])->name('on_product');
			Route::get('off/{id}', [ProductController::class, 'OffProduct'])->name('off_product');

			Route::get('ok/{id}', [ProductController::class, 'OkProduct'])->name('ok_product');
			Route::get('no/{id}', [ProductController::class, 'NoProduct'])->name('no_product');

			Route::get('delete/{id}', [ProductController::class, 'getProductDelete'])->name('product_delete');
		});

		Route::prefix('supplier')->group(function () {
			Route::get('/', [SupplierController::class, 'getSupplierList'])->name('supplier_list');

			Route::get('add', [SupplierController::class, 'getSupplierAdd'])->name('supplier_add');
			Route::post('add', [SupplierController::class, 'postSupplierAdd'])->name('supplier_add');

			Route::get('edit/{id}', [SupplierController::class, 'getSupplierEdit'])->name('supplier_edit');
			Route::post('edit', [SupplierController::class, 'postSupplierEdit'])->name('supplier_update');

			Route::get('delete/{id}', [SupplierController::class, 'getSupplierDelete'])->name('supplier_delete');
		});

		Route::prefix('slide')->group(function () {
			Route::get('/', [SlideController::class, 'getSlideList'])->name('slide_list');
			Route::post('/', [SlideController::class, 'postSlideAdd'])->name('slide_list');

			Route::get('edit/{id}', [SlideController::class, 'getSlideEdit'])->name('slide_edit');
			Route::post('edit', [SlideController::class, 'postSlideEdit'])->name('slide_update');

			Route::get('on/{id}', [SlideController::class, 'getOn'])->name('slide_on');
			Route::get('off{id}', [SlideController::class, 'getoff'])->name('slide_off');

			Route::get('delete/{id}', [SlideController::class, 'getSlideDelete'])->name('slide_delete');
		});

		Route::prefix('sale-banner')->group(function () {
			Route::get('/', [SaleBannerController::class, 'getSaleBannerList'])->name('salebanner_list');
			Route::post('/', [SaleBannerController::class, 'postSaleBannerAdd'])->name('salebanner_list');

			Route::get('edit/{id}', [SaleBannerController::class, 'getSaleBannerEdit'])->name('salebanner_edit');
			Route::post('edit', [SaleBannerController::class, 'postSaleBannerEdit'])->name('salebanner_update');

			Route::get('on/{id}', [SaleBannerController::class, 'getOn'])->name('salebanner_on');
			Route::get('off{id}', [SaleBannerController::class, 'getoff'])->name('salebanner_off');

			Route::get('delete/{id}', [SaleBannerController::class, 'getSaleBannerDelete'])->name('salebanner_delete');
		});

		Route::prefix('order-all')->group(function () {
			Route::get('/', [OrderAllController::class, 'getOrder'])->name('order_all');
			Route::post('/', [OrderAllController::class, 'postSearch'])->name('all_search');
			Route::get('received-active-none/{id}', [OrderAllController::class, 'getReceivedActiveNone'])->name('receive_none_all');
			Route::get('received-active/{id}', [OrderAllController::class, 'getReceivedActive'])->name('receivedactive_all');
			Route::get('moved-active-none/{id}', [OrderAllController::class, 'getMovedActiveNone'])->name('moved_none_all');
			Route::get('moved-active/{id}', [OrderAllController::class, 'getMovedActive'])->name('movedactive_all');
			Route::get('complete-active-none/{id}', [OrderAllController::class, 'getCompleteActiveNone'])->name('complete_none_all');
			Route::get('complete-active/{id}', [OrderAllController::class, 'getCompleteActive'])->name('completeactive_all');
			Route::get('cancel-active-none/{id}', [OrderAllController::class, 'getCancelActiveNone'])->name('cancel_none_all');
			Route::get('cancel-active/{id}', [OrderAllController::class, 'getCancelActive'])->name('cancelactive_all');
			Route::get('delete/{id}', [OrderAllController::class, 'getDelete'])->name('delete_all');
		});

		Route::prefix('order-received')->group(function () {
			Route::get('/', [OrderReceivedController::class, 'getOrder'])->name('order_received');
			Route::post('/', [OrderReceivedController::class, 'postSearch'])->name('received_search');
			Route::get('moved-active/{id}', [OrderReceivedController::class, 'getMovedActive'])->name('movedactive_received');
			Route::get('cancel-active/{id}', [OrderReceivedController::class, 'getCancelActive'])->name('cancelactive_received');
		});
		Route::prefix('order-moved')->group(function () {
			Route::get('/', [OrderMovedController::class, 'getOrder'])->name('order_moved');
			Route::post('/', [OrderMovedController::class, 'postSearch'])->name('moved_search');
			Route::get('complete-active/{id}', [OrderMovedController::class, 'getCompleteActive'])->name('completeactive_moved');
			Route::get('cancel-active/{id}', [OrderMovedController::class, 'getCancelActive'])->name('cancelactive_moved');
		});

		Route::prefix('order-complete')->group(function () {
			Route::get('/', [OrderCompleteController::class, 'getOrder'])->name('order_complete');
			Route::post('/', [OrderCompleteController::class, 'postSearch'])->name('complete_search');
			Route::get('delete/{id}', [OrderCompleteController::class, 'getDelete'])->name('delete_complete');
		});

		Route::prefix('order-cancel')->group(function () {
			Route::get('/', [OrderCancelController::class, 'getOrder'])->name('order_cancel');
			Route::post('/', [OrderCancelController::class, 'postSearch'])->name('cancel_search');
			Route::get('delete/{id}', [OrderCancelController::class, 'getDelete'])->name('delete_cancel');
		});

		Route::prefix('store')->group(function () {
			Route::get('/', [StoreController::class, 'getStore'])->name('store');
			Route::get('add-size/{id}', [StoreController::class, 'getAddSize'])->name('add_size');
			Route::post('add-size', [StoreController::class, 'postAddSize'])->name('update_size');

			Route::get('add-store/{id}', [StoreController::class, 'getAddStore'])->name('add_store');

			Route::get('add-quantity/{id}', [StoreController::class, 'getAddQuantity'])->name('add_quantity');
			Route::post('add-quantity', [StoreController::class, 'postAddQuantity'])->name('update_quantity');

			Route::get('edit-size/{id}', [StoreController::class, 'getEditSize'])->name('edit_size');
			Route::post('edit-size', [StoreController::class, 'postEditSize'])->name('update_sizes');

			Route::get('delete-size/{id}', [StoreController::class, 'getDeleteSize'])->name('delete_size');
		});
		Route::prefix('users')->group(function () {
			Route::get('/', [UsersController::class, 'getUsers'])->name('user');
			Route::post('/', [UsersController::class, 'postSearchUser'])->name('search_user');
			Route::get('admin-active/{id}', [UsersController::class, 'getAdminActive'])->name('admin_active');
			Route::get('user-active/{id}', [UsersController::class, 'getUserActive'])->name('user_active');
			Route::get('user-delete/{id}', [UsersController::class, 'getUserDelete'])->name('user_delete');
		});
	});
});

//cong thanh toan