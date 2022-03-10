<?php

use App\Http\Controllers\AlibabaController;
use App\Http\Controllers\AmazonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ConsultingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\SendMailContactController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UploadController;
use App\Models\Post;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route Auth
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::get('auth/logout', [AuthController::class, 'logout']);
// Route::get('auth/user', [AuthController::class, 'user']);

// Route::group(['middleware' => ['auth']], function () {
//     Route::get('auth/user', [AuthController::class, 'user']);
// });

// Route::group([
//     'middleware' => 'testJWT',
//     'prefix' => 'auth'
// ], function ($router) {
//     Route::get('auth/user', [AuthController::class, 'user']);
// });

Route::get('auth/user', [AuthController::class, 'user']);

// Route::group(['middleware' => 'jwtnew'], function () {
//     Route::get('auth/user', [AuthController::class, 'user']);
// });
Route::group(['middleware' => 'jwt.verify'], function () {
    Route::get('auth/refresh', 'AuthController@refresh');
});


Route::group(['middleware' => 'jwt.verify'], function () {
    // Route::get('auth/user', [AuthController::class, 'user']);
    // Route Auth
    
    Route::put('auth/changePassword/{id}', [AuthController::class, 'changePassword']);

    // Route Dashboard
    Route::get('dashboard', [DashboardController::class, 'count']);

   

    //Route setting
    Route::get('settings', [SettingController::class, 'index']);
    Route::get('settings/show/{id}', [SettingController::class, 'show']);
    Route::post('settings/store', [SettingController::class, 'store']);
    Route::put('settings/update/{id}', [SettingController::class, 'update']);
    Route::delete('settings/destroy/{id}', [SettingController::class, 'destroy']);

   

    //Route Menu
    Route::put('menus/updateStatus/{id}', [MenuController::class, 'updateStatus']);
    Route::post('menus/store', [MenuController::class, 'store']);
    Route::put('menus/update/{id}', [MenuController::class, 'update']);
    Route::delete('menus/destroy/{id}', [MenuController::class, 'destroy']);

    //Route CategoryProduct
    Route::put('category_product/updateStatus/{id}', [CategoryProductController::class, 'updateStatus']);
    Route::post('category_product/store', [CategoryProductController::class, 'store']);
    Route::put('category_product/update/{id}', [CategoryProductController::class, 'update']);
    Route::delete('category_product/destroy/{id}', [CategoryProductController::class, 'destroy']);

   

     
    //Route Slide
    Route::put('slide/update/{id}', [SlideController::class, 'update']);
    Route::delete('slide/destroy/{id}', [SlideController::class, 'destroy']);
    Route::post('slide/store', [SlideController::class, 'store']);

    Route::put('categories/update/{id}', [CategoryController::class, 'update']);
    Route::put('category_product/updatePosition', [CategoryProductController::class, 'updatePosition']);
    Route::put('categories/updatePosition', [CategoryController::class, 'updatePosition']);
    Route::put('menus/updatePosition', [MenuController::class, 'updatePosition']);

});
// Route Post
Route::get('posts/listPost', [PostController::class, 'listPost']);
Route::get('posts/getListPopular', [PostController::class, 'getListPopular']);
Route::get('posts/getListNew', [PostController::class, 'getListNew']);
Route::get('posts/show/{id}', [PostController::class, 'show']);
Route::get('posts/getListRadom', [PostController::class, 'getListRadom']);

// Route Product
Route::get('product/listProduct', [ProductController::class, 'listProduct']);
Route::get('product/show/{id}', [ProductController::class, 'show']);
Route::post('product/store', [ProductController::class, 'store']);
Route::put('product/updateStatus/{id}', [ProductController::class, 'updateStatus']);
Route::put('product/update/{id}', [ProductController::class, 'update']);
Route::delete('product/destroy/{id}', [ProductController::class, 'destroy']);
Route::get('product', [ProductController::class, 'index']);

// Route category
Route::get('categories/listCategory', [CategoryController::class, 'listCategory']);
Route::get('categories/show/{id}', [CategoryController::class, 'show']);

// Route Menu
Route::get('menus/listMenu', [MenuController::class, 'listMenu']);
Route::get('menus/show/{id}', [MenuController::class, 'show']);
Route::get('menus', [MenuController::class, 'index']);

// Route Menu
Route::get('category_product/listCategoryProduct', [CategoryProductController::class, 'listCategoryProduct']);
Route::get('category_product/show/{id}', [CategoryProductController::class, 'show']);
Route::get('category_product', [CategoryProductController::class, 'index']);


// Route Keyword
Route::get('keywords', [KeywordController::class, 'index']);

//Route Send mail
Route::get('send/mail-contact', [SendMailContactController::class, 'sendMailContact']);

Route::post('mail-contact', [SendMailContactController::class, 'send']);

//Route slide
Route::get('slides', [SlideController::class, 'index']);
Route::get('slide/show/{id}', [SlideController::class, 'show']);

// Route User
Route::get('users', [UserController::class, 'index']);
Route::get('users/show/{id}', [UserController::class, 'show']);
Route::put('users/updateStatus/{id}', [UserController::class, 'updateStatus']);
Route::post('users/store', [UserController::class, 'store']);
Route::put('users/update/{id}', [UserController::class, 'update']);
Route::delete('users/destroy/{id}', [UserController::class, 'destroy']);

//Route Category
Route::put('categories/updateStatus/{id}', [CategoryController::class, 'updateStatus']);
Route::post('categories/store', [CategoryController::class, 'store']);
Route::put('categories/update/{id}', [CategoryController::class, 'update']);
Route::delete('categories/destroy/{id}', [CategoryController::class, 'destroy']);
Route::get('categories', [CategoryController::class, 'index']);

//Route Brand
Route::put('brands/updateStatus/{id}', [BrandController::class, 'updateStatus']);
Route::post('brand/store', [BrandController::class, 'store']);
Route::put('brand/update/{id}', [BrandController::class, 'update']);
Route::delete('brand/destroy/{id}', [BrandController::class, 'destroy']);
Route::get('brands', [BrandController::class, 'index']);
Route::get('brand/show/{id}', [BrandController::class, 'show']);

//Route Size
Route::post('size/store', [SizeController::class, 'store']);
Route::put('size/update/{id}', [SizeController::class, 'update']);
Route::delete('size/destroy/{id}', [SizeController::class, 'destroy']);
Route::get('sizes', [SizeController::class, 'index']);

//Route Color
Route::post('color/store', [ColorController::class, 'store']);
Route::put('color/update/{id}', [ColorController::class, 'update']);
Route::delete('color/destroy/{id}', [ColorController::class, 'destroy']);
Route::get('colors', [ColorController::class, 'index']);

//Route ProductDetail
Route::post('productDetail/store', [ProductDetailController::class, 'store']);
Route::put('productDetail/update/{id}', [ProductDetailController::class, 'update']);
Route::delete('productDetail/destroy/{id}', [ProductDetailController::class, 'destroy']);
Route::get('productDetails', [ProductDetailController::class, 'index']);
Route::get('listProductDetails', [ProductDetailController::class, 'join']);


Route::get( 'productLists', [ProductController::class, 'productLists']);
Route::get('productLists/category/{id}', [ProductController::class, 'productByCategory']);
Route::get( 'productLists/brand/{id}', [ProductController::class, 'productByBrand']);
Route::get( 'productLists/color/{id}', [ProductController::class, 'productByColor']);
Route::get('productShow/{id}', [ProductController::class, 'productShow']);

Route::get('product/show/{id}', [ProductController::class, 'productShow']);


// Post
Route::post('posts/store', [PostController::class, 'store']);
Route::put('posts/updateStatus/{id}', [PostController::class, 'updateStatus']);
Route::put('posts/update/{id}', [PostController::class, 'update']);
Route::delete('posts/destroy/{id}', [PostController::class, 'destroy']);
Route::get('posts', [PostController::class, 'index']);

//Upload image
Route::post('/upload-image', [UploadController::class, 'image']);

Route::post('/upload', [FileController::class, 'upload']);


// Cart 
Route::post('carts/store', [ShoppingCartController::class, 'store']);
Route::post('carts', [ShoppingCartController::class, 'store']);
Route::put('carts/update/{id}', [ShoppingCartController::class, 'update']);
Route::delete('carts/destroy/{id}', [ShoppingCartController::class, 'destroy']);
Route::get('carts', [ShoppingCartController::class, 'index']);

// Cart 
Route::get('/', [ProductController::class, 'productList'])->name('products.list');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');


Route::post('cart', [CartController::class, 'addToCart']);
Route::get('cart', [CartController::class, 'cartList']);
Route::get('checkout/get/items', [CartController::class, 'getCartItemsForCheckout']);
Route::post('payment', [CartController::class, 'payment']);
Route::delete('removeItemOrder/{id}', [OrderController::class, 'removeItemOrder']);

//Customer
Route::get('purchase', [CustomerController::class, 'purchase']);


//Order
Route::get('orderList', [OrderController::class, 'listOrder']);

