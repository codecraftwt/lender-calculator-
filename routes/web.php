<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LenderController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Auth;

use App\Models\ProductTypeModel;



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


// index routes
Route::get('/', function () {
    $restricted_industries = ProductTypeModel::whereNotNull('restricted_industry')
        ->pluck('restricted_industry')
        ->map(function ($item) {
            return json_decode($item, true);
        })
        ->flatten()
        ->unique()
        ->values();
    return view('Index.index', compact('restricted_industries'));
});
Route::get('/index', [IndexController::class, 'index']);
Route::get('/index2', [IndexController::class, 'index_test']);
Route::get('/broker', [IndexController::class, 'broker_panel']);
Route::get('/get-lender', [IndexController::class, 'get_lenders'])->name('get.lenders');
Route::get('/lenders', function () {
    return 'Lenders page coming soon.';
});
Route::get('/contact-us', function () {
    return 'Contact us page coming soon.';
});


// customer routes
Route::post('/save_data', [CustomerController::class, 'save_data']);
Route::get('/customer-edit/{id}', [CustomerController::class, 'customer_edit']);
Route::get('/customer-delete/{id}', [CustomerController::class, 'customer_delete']);
Route::post('/update-customer-status', [CustomerController::class, 'update_customer_status']);
Route::post('/update-customer', [CustomerController::class, 'update_customer']);
Route::get('/customer-list', [CustomerController::class, 'list'])->middleware('auth');
Route::get('/get-customers', [CustomerController::class, 'get_customers'])->middleware('auth');
Route::get('/get-applicable-lenders', [CustomerController::class, 'get_applicable_lenders'])->middleware('auth');
Route::get('/get-sub-products', [CustomerController::class, 'get_sub_products'])->middleware('auth');


// api route
// Route::get('/search-company', 'CompanySearchController@searchCompany');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// lender routes
Route::get('/lender-list', [LenderController::class, 'lender_list']);
Route::get('/get-lenders', [LenderController::class, 'get_lenders']);
Route::get('/get-lender-products', [LenderController::class, 'get_lender_products']);
Route::get('/get-lender-subproducts', [LenderController::class, 'get_lender_subproducts']);
Route::get('/get-product-data-with-subproducts', [LenderController::class, 'get_product_data_with_subproducts']);
Route::get('/get-sub-product-data', [LenderController::class, 'get_sub_product_data']);

Route::get('/get-lender-contacts', [LenderController::class, 'get_lender_contacts']);

Route::get('/lender-edit/{id}', [LenderController::class, 'lender_edit']);

Route::post('/update-main-lender-data', [LenderController::class, 'update_main_lender_data']);
Route::post('/update-product-data', [LenderController::class, 'update_product_data']);
Route::post('/update-sub-product-data', [LenderController::class, 'update_sub_product_data']);

// add user
Route::get('/add-user', [UserController::class, 'add_user'])->middleware(['auth', 'admin']);
Route::post('/store-user', [UserController::class, 'store_user'])->middleware(['auth', 'admin']);



Route::get('/slider', function () {
    return view('lender.slider');
});
