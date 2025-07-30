<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CustomerController;
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

Route::get('/get-lenders', [IndexController::class, 'get_lenders'])->name('get.lenders');
Route::get('/lenders', function () {
    return 'Lenders page coming soon.';
});

Route::get('/contact-us', function () {
    return 'Contact us page coming soon.';
});


Route::post('/save_data', [CustomerController::class, 'save_data']);

Route::get('/customer-list', [CustomerController::class, 'list']);
Route::get('/get-customers', [CustomerController::class, 'get_customers']);
Route::get('/get-applicable-lenders', [CustomerController::class, 'get_applicable_lenders']);

Route::get('/search-company', 'CompanySearchController@searchCompany');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
