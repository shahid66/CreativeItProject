<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\FilterProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfielController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\WishListController;
use App\Models\CustomerLogin;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


//Logout Default
Route::get('/logout/admin',[LoginController::class,'logout'])->name('logout.admin');


//Front End

Route::get('/', [FrontendController::class, 'Index']);
Route::get('/product_details/{product_id}', [FrontendController::class, 'product_details'])->name('product.details');
Route::post('/getSize', [FrontendController::class, 'getSize']);
Route::post('/getQuantityAvailable', [FrontendController::class, 'getQuantityAvailable']);
//Customer login
Route::post('/customer/login', [CustomerLoginController::class, 'customer_login']);
Route::get('/customer/logOut', [CustomerLoginController::class, 'customer_logOut'])->name('customer.logOut');
Route::post('/customer/register', [CustomerRegisterController::class, 'customer_register']);
Route::get('/customer/register/view', [CustomerRegisterController::class, 'customer_register_view'])->name('customer.register.view');

//Customer Dashboard
Route::get('/customerAccount/{customer_id}', [CustomerController::class, 'getCustomer'])->name('customer.me');
// Admin
Route::get('/home2', [AdminController::class, 'Index']);
Route::post('/add/users', [AdminController::class, 'add_user']);
Route::get('/profile/delete/{user_id}',[AdminController::class, 'userDelete'])->name('user.delete');

// Profile Edit Admin Part

Route::get('/profile',[ProfielController::class, 'Index']);
Route::post('/profile/name/update',[ProfielController::class, 'NameUpdate']);
Route::post('/profile/password/update',[ProfielController::class, 'PasswordUpdate']);
Route::post('/profile/image/update',[ProfielController::class, 'ProfileChange']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Category

Route::get('/category', [CategoryController::class, 'Index']);
Route::post('/category/insert', [CategoryController::class, 'Insert']);
Route::get('/category/delete/{cat_id}', [CategoryController::class, 'Delete']);
Route::get('/category/edit/{cat_id}', [CategoryController::class, 'Edit']);
Route::post('/category/update', [CategoryController::class, 'Update']);
Route::post('/category/image/update', [CategoryController::class, 'UpdateImage']);

// SubCategory

Route::get('/subcategory', [SubcategoryController::class, 'Index']);
Route::post('/subcategory/insert', [SubcategoryController::class, 'Insert']);
Route::get('/subcategory/delete/{cat_id}', [SubcategoryController::class, 'Delete']);
Route::get('/subcategory/edit/{cat_id}', [SubcategoryController::class, 'Edit']);
Route::get('/subcategory/restore/{cat_id}', [SubcategoryController::class, 'Restore']);
Route::get('/subcategory/permanentDelete/{cat_id}', [SubcategoryController::class, 'PermanentDelete']);
Route::post('/subcategory/update', [SubcategoryController::class, 'Update']);

// Products
Route::get('/product', [ProductController::class, 'Index']);
Route::post('/getSubCategory', [ProductController::class, 'getSubCategory']);
Route::post('/product/insert', [ProductController::class, 'ProductInsert']);

// inventory
Route::get('/InventoryIndex/{product_id}', [ProductController::class, 'InventoryIndex']);
Route::get('/InventoryIndex/{inventory_id}', [ProductController::class, 'InventoryDelete'])->name('inventory.delete');
Route::post('/InventoryInsert', [ProductController::class, 'InventoryInsert']);
Route::get('/color/size', [ProductController::class, 'ColorSize']);
Route::post('/color/size/insert', [ProductController::class, 'ColorInsert']);
Route::post('/size/insert', [ProductController::class, 'SizeInsert']);

// Cart

Route::post('/cart/insert',[CartController::class, 'cartInsert']);
Route::get('/cart/delete/{cart_id}',[CartController::class, 'cartDelete'])->name('cart.delete');
Route::get('/cart/clear',[CartController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart/all',[CartController::class, 'allCartItem'])->name('allCartItem');
// Route::get('/cart/all/{coupon_code}',[CartController::class, 'allCartItem']);
Route::post('/cart/update/quantity',[CartController::class, 'CartItemUpdateQuantity'])->name('allCartItem.update.quantity');

//Coupon

Route::get('/coupon',[CouponController::class, 'Coupon'])->name('coupon');
Route::post('/coupon/insert',[CouponController::class, 'CouponInsert'])->name('coupon.insert');

//CheckOut
Route::get('/checkOut',[CheckOutController::class, 'checkOut'])->name('checkOut');
Route::get('/congratulation',[CheckOutController::class, 'congratulation'])->name('congratulation');
Route::post('/getCity',[CheckOutController::class, 'getCity']);
Route::post('/order/insert',[CheckOutController::class, 'orderInsert']);
Route::get('/order/admin/view',[CheckOutController::class, 'orderAdminView'])->name('order.admin.view');
//WishList
Route::get('/wishInsert/{product_id}',[WishListController::class, 'wishInsert'])->name('wishInsert');
Route::get('/wishInsert/delete/{product_id}',[WishListController::class, 'wishDelete'])->name('wishInsert.delete');

//Filter Part

Route::get('/filterProduct',[FilterProductController::class, 'index'])->name('filter.index');


