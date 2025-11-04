<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LenderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbnController;
use App\Http\Controllers\GoogleSheetController;





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
Route::post('/get-lender', [IndexController::class, 'get_lenders'])->name('get.lenders')->middleware(['auth', 'role:Admin,Broker']);
Route::get('/lenders', function () {
    return 'Lenders page coming soon.';
});
Route::get('/contact-us', function () {
    return 'Contact us page coming soon.';
});


// customer routes
Route::post('/save_data', [CustomerController::class, 'save_data'])->middleware(['auth', 'role:Admin,Broker']);
Route::get('/customer-edit/{id}', [CustomerController::class, 'customer_edit'])->middleware('auth', 'role:Admin,Broker');
Route::get('/customer-delete/{id}', [CustomerController::class, 'customer_delete'])->middleware('auth', 'role:Admin,Broker');
Route::post('/update-customer-status', [CustomerController::class, 'update_customer_status'])->middleware('auth', 'role:Admin,Broker');
Route::post('/update-customer', [CustomerController::class, 'update_customer'])->middleware('auth', 'role:Admin,Broker');
Route::get('/customer-list', [CustomerController::class, 'list'])->middleware('auth', 'role:Admin,Broker');
Route::post('/get-customers', [CustomerController::class, 'get_customers'])->middleware('auth', 'role:Admin,Broker');
Route::post('/get-applicable-lenders', [CustomerController::class, 'get_applicable_lenders'])->middleware('auth', 'role:Admin,Broker');
Route::post('/get-sub-products', [CustomerController::class, 'get_sub_products'])->middleware('auth', 'role:Admin,Broker');


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
Route::post('/get-lenders', [LenderController::class, 'get_lenders']);
Route::post('/get-lender-products', [LenderController::class, 'get_lender_products']);
Route::post('/get-lender-subproducts', [LenderController::class, 'get_lender_subproducts']);
Route::post('/get-product-data-with-subproducts', [LenderController::class, 'get_product_data_with_subproducts']);
Route::post('/get-sub-product-data', [LenderController::class, 'get_sub_product_data']);

Route::post('/get-lender-contacts', [LenderController::class, 'get_lender_contacts']);
Route::post('/search-contact', [LenderController::class, 'search_contact']);
Route::post('/search-contact-details', [LenderController::class, 'search_contact_details'])->middleware('auth', 'role:Admin');
Route::post('/update-lender-contact-data', [LenderController::class, 'update_lender_contact_data'])->middleware('auth', 'role:Admin');


// Route::post('/lender-edit/', [LenderController::class, 'lender_edit']);
Route::post('/update-main-lender-data', [LenderController::class, 'update_main_lender_data'])->middleware('auth', 'role:Admin');
Route::post('/update-product-data', [LenderController::class, 'update_product_data'])->middleware('auth', 'role:Admin');
Route::post('/update-sub-product-data', [LenderController::class, 'update_sub_product_data'])->middleware('auth', 'role:Admin');

// add user
Route::get('/add-user', [UserController::class, 'add_user'])->middleware(['auth', 'role:Admin']);
Route::post('/store-user', [UserController::class, 'store_user'])->middleware(['auth', 'role:Admin']);

// Add Lender Product
Route::post('/add-new-product', [LenderController::class, 'add_new_product'])->middleware(['auth', 'role:Admin']);
Route::post('/add-new-sub-product', [LenderController::class, 'add_new_sub_product'])->middleware(['auth', 'role:Admin']);
Route::post('/add-new-contact', [LenderController::class, 'add_new_contact'])->middleware(['auth', 'role:Admin']);
Route::post('/delete-lender-contact', [LenderController::class, 'delete_lender_contact'])->middleware(['auth', 'role:Admin']);
Route::post('/add-new-lender', [LenderController::class, 'add_new_lender'])->middleware(['auth', 'role:Admin']);
Route::post('/delete-lender', [LenderController::class, 'delete_lender'])->middleware(['auth', 'role:Admin']);


// user list routes

Route::get('/user-list', [UserController::class, 'user_list'])->middleware(['auth', 'role:Admin']);
Route::post('/get-users', [UserController::class, 'get_users'])->middleware(['auth', 'role:Admin']);
Route::post('/update-user-status', [UserController::class, 'update_user_status'])->middleware(['auth', 'role:Admin']);
Route::post('/get-user-data', [UserController::class, 'get_user_data'])->middleware(['auth', 'role:Admin']);
Route::post('/update-user-data', [UserController::class, 'update_user_data'])->middleware(['auth', 'role:Admin,Broker']);
Route::post('/update-user-profile', [UserController::class, 'update_user_profile'])->middleware(['auth', 'role:Admin,Broker']);
Route::post('send-password-change-otp', [UserController::class, 'send_password_change_otp'])->middleware(['auth', 'role:Admin,Broker']);


// delete lender product and subproduct routes
Route::post('/delete-lender-product', [LenderController::class, 'delete_lender_product'])->middleware(['auth', 'role:Admin']);
Route::post('/delete-lender-sub-product', [LenderController::class, 'delete_lender_sub_product'])->middleware(['auth', 'role:Admin']);

// filter routes 
Route::get('filter-customers', [CustomerController::class, 'filter_customers']);



Route::get('/slider', function () {
    return view('lender.slider');
});


Route::get('admin-dashboard', [IndexController::class, 'admin_dashboard']);
Route::get('admin-table', [IndexController::class, 'admin_table']);
Route::get('admin-login', [IndexController::class, 'admin_login']);

Route::get('/fetch-bank-statement', [AbnController::class, 'fetch_bank_statement'])->middleware(['auth', 'role:Admin,Broker']);
Route::post('/store-illion-data', [GoogleSheetController::class, 'storeIllionData'])->middleware(['auth', 'role:Admin,Broker']);
