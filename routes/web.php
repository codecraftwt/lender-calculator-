<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;

use App\Models\LenderModel;



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

    $trading_times = LenderModel::select('trading_time')->groupBy('trading_time')->get();
    $loan_formats = LenderModel::select('loan_format')->groupBy('loan_format')->get();
    $loan_terms = LenderModel::select('loan_term')->groupBy('loan_term')->get();
    $bank_statements = LenderModel::select('bank_statement_type')->groupBy('bank_statement_type')->get();

    $guaranteeTypes = LenderModel::whereNotNull('guarantee_type')
        ->pluck('guarantee_type')
        ->map(function ($item) {
            return json_decode($item, true);
        })
        ->flatten()
        ->unique()
        ->values();

    $decision_times = LenderModel::select('decision_time')->groupBy('decision_time')->get();

    $repayment_frequency = LenderModel::whereNotNull('repayment_frequency')
        ->pluck('repayment_frequency')
        ->map(function ($item) {
            return json_decode($item, true);
        })
        ->flatten()
        ->unique()
        ->values();


    $industries = LenderModel::select('restricted_industry_type', 'allowed_industry_type')
        ->get()
        ->flatMap(function ($lender) {
            $restricted = json_decode($lender->restricted_industry_type, true) ?? [];
            $allowed = json_decode($lender->allowed_industry_type, true) ?? [];
            return array_merge($restricted, $allowed);
        })
        ->map(function ($item) {
            return trim(strtolower($item));  // normalize strings for uniqueness
        })
        ->unique()
        ->values()
        ->map(function ($item) {
            return ucfirst($item);
        });
    return view('Index.index', compact('trading_times', 'loan_formats', 'loan_terms', 'bank_statements', 'guaranteeTypes', 'decision_times', 'repayment_frequency', 'industries'));
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
