<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionsController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\frontend\ProductsController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\frontend\VendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::prefix('admin')->group(function () {
    // Admin login Route without admin group
    Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('admin.login');
    // admin check varifies security with middleware group
    Route::group(['middleware' => ['admin']], function () {
        // Admin Dashboard without admin group
        Route::get('dashboard', [AdminController::class, 'dashboard']);
        // update admin password
        Route::match(['get', 'post'], 'update-admin-password', [AdminController::class, 'UpdateAdminPassword']);
        // chack admin password valid or invalid
        Route::post('check-current-password', [AdminController::class, 'CheckAdminPassword']);
        // Update admin details
        Route::match(['get', 'post'], 'update-admin-detail', [AdminController::class, 'CheckAdminDateils']);
        // update vendor Details 
        Route::match(['get', 'post'], 'update-vendor-detail/{slug}', [AdminController::class, 'UpdateVendorDetail']);
        // view Admin / Subadmin / Vendor 
        Route::get('admins/{type?}', [AdminController::class, 'admins']);
        // view Vendor Details 
        Route::get('/view-vendor-details/{id}', [AdminController::class, 'viewVendorDtails']);
        // admin update status
        Route::post('admin-update-status', [AdminController::class, 'adminUpdateStatus']);
        // Sections  Route Start
        Route::get('sections', [SectionsController::class, 'sections'])->name('sections');
        // section avtive and inactive 
        Route::post('section-update-status', [SectionsController::class, 'sectionUpdateStatus']);
        // Edit the section
        Route::match(['get', 'post'], 'add-edit-section/{id?}', [SectionsController::class, 'editSection']);
        // Delete the section
        Route::get('delete-section/{id}', [SectionsController::class, 'destroySection']);
        // Section Route End
        // Hare your Route Start for Categories
        // Show categories 
        Route::get('/categories', [CategoriesController::class, 'categories']);
        Route::post('category-update-status', [CategoriesController::class, 'categoryUpdateStatus']);
        // add edit category
        Route::match(['get', 'post'], 'add-edit-category/{id?}', [CategoriesController::class, 'addEditCategory']);
        Route::get('append-category-level', [CategoriesController::class, 'appendCategoryLevel']);
        Route::get('delete-category/{id}', [CategoriesController::class, 'detaleCategory']);
        Route::get('delete-category-image/{id}', [CategoriesController::class, 'detaleCategoryImage']);
        // Category Route End hare 
        // Brands start here
        Route::get('brands', [BrandsController::class, 'Brands']);
        // section avtive and inactive 
        Route::post('brand-update-status', [BrandsController::class, 'brandsUpdateStatus']);
        // Edit the brand
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', [BrandsController::class, 'addEditBrands']);
        // Delete the brand
        Route::get('delete-brand/{id}', [BrandsController::class, 'destroyBrand']);
        // Brands end here 
        // Products Route Start hare
        Route::get('products', [ProductController::class, 'Products']);
        Route::post('product-update-status', [ProductController::class, 'productsUpdateStatus']);
        Route::match(['get', 'post'], 'add-edit-product/{id?}', [ProductController::class, 'addEditProducts']);
        Route::get('delete-product/{id}', [ProductController::class, 'destroyProduct']);
        Route::get('delete-product-image/{id}', [ProductController::class, 'destroyProductImage']);
        Route::get('delete-product-vedio/{id}', [ProductController::class, 'destroyProductVedio']);
        // section avtive and inactive 
        // Products Route End 
        // Route start for the Attributes
        Route::match(['get', 'post'], 'add-edit-attribute/{id?}', [ProductController::class, 'addEditAttributes']);
        // Product Status update
        Route::post('product-attribute-update-status', [ProductController::class, 'productsAttributeStatus']);
        Route::get('delete-attribute/{id}', [ProductController::class, 'destroyProductAttribute']);
        Route::post('edit-attribute/{id}', [ProductController::class, 'editAttribute']);
        Route::match(['get', 'post'], 'Add-Images/{id}', [ProductController::class, 'AddImages']);
        Route::post('images-update-status', [ProductController::class, 'productsImagesUpdateStatus']);
        Route::get('delete-product-images/{id}', [ProductController::class, 'destroyProductimages']);
        // banner section
        Route::get('banner',[BannerController::class,'banner']);
        Route::post('banner-update-status', [BannerController::class, 'bannerUpdateStatus']);
        Route::match(['get','post'],'add-edit-banner/{id?}',[BannerController::class,'addEditBanner']);
        Route::get('delete-banner/{id}',[BannerController::class,'deleteBanner']);
        Route::get('fact', [BrandsController::class, 'fact']);

        // filter
        Route::get('filter',[FilterController::class,'filters']);
        Route::post('filter-update-status',[FilterController::class,'filterstatusupdate']);
        Route::match(['get','post'],'add-edit-filter/{id?}',[FilterController::class,'AddEditFilter']);
        Route::get('delete-filter/{id}',[FilterController::class,'deletefilter']);
        Route::get('filter-value',[FilterController::class,'filtersValue']);
        Route::match(['get','post'],'add-edit-filter-value/{id?}',[FilterController::class,'AddEditFilterValue']);
        Route::post('category-filters',[FilterController::class,'categoryFilters']);
        // Admin Logout     


        Route::get('logout', [AdminController::class, 'logout']);
    });
});
// Frontend Side
Route::get('/', [IndexController::class,'index']);
// Listing the Categories Route
$catUrl = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
foreach ($catUrl as $key => $Url) {
Route::match(['get','post'],'/'.$Url,[ProductsController::class,'Listing']);
}
Route::get('/product/{id}',[ProductsController::class,'productDetail']);

Route::get('/products/{vendorid}',[ProductsController::class,'vendorlisting']);

Route::post('/get-product-price',[ProductsController::class,'getProductPrice']);

// add to cart product
Route::get('/cart',[ProductsController::class,'Cart'])->name('check.cart');
Route::post('/add-to-cart',[ProductsController::class,'addToCart'])->name('add.to.cart');
Route::post('/cart/update',[ProductsController::class,'updateCartItemQty'])->name('update.cart.item.qty');
Route::post('/cart/delete',[ProductsController::class , 'cartDelete']);

// vendor Login
Route::get('vendor-login',[VendorController::class,'Vendor_login'])->name('vendor.login');
// vendor register 
Route::post('vendor-register',[VendorController::class,'Vendor_register'])->name('vendor.register');
// confirm massage
Route::get('vendor/confirm/{code}',[VendorController::class,'vendorConfirm']);
// Users Controller 
Route::get('user-login',[UserController::class,'user_register'])->name('user.login');
Route::post('login/register',[UserController::class,'userRegister'])->name('user.register');
Route::post('user/login-register',[UserController::class,'userLoginRegister'])->name('user.login.register');
// user forgot password

Route::match(['get','post'],'user/forgot/password',[UserController::class,'userForgotPassword'])->name('user.forgot.password');
Route::get('user/logout',[UserController::class,'userLogout'])->name('user.logout');