<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeakController;
use App\Http\Controllers\RootController;
use App\Http\Controllers\ProblemController;

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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/record2', function () {
    return view('Record02');
})->name('index2');

Route::get('/approve', function () {
    return view('apr_linecall');
})->name('approve');

Route::get('/rankmaster', function () {
    return view('RankApp');
})->name('rankmaster');

Route::get('/reports' , function (){
    return view('reports');
})->name('reports');


//Route::get('/images_upload',[ImageController::class , 'index'])->name('images-upload');

//บันทึกข้อมูล Leak and Root 5 Why
Route::post('/LeakRecord' , [LeakController::class , 'recordLeak'])->name('recordLeak');
Route::post('/ProblemRecord' , [ProblemController::class , 'recordPrb'])->name('recordPrb');
