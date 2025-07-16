<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
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

    return view('Index.index', compact('trading_times', 'loan_formats', 'loan_terms'));
});

Route::get('/index', [IndexController::class, 'index']);
Route::get('/index2', [IndexController::class, 'index_test']);
Route::get('/get-lenders', [IndexController::class, 'get_lenders']);
