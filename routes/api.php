<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\DataformController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/images' , [ProblemController::class , 'fetchDataProblem']);
Route::get('/showform01' , [DataformController::class , 'fetchDataRec01'])->name('data_first');
Route::get('/showform02' , [DataformController::class , 'fetchDataRec02'])->name('data_second');
Route::get('/showdata/record' , [DataformController::class , 'fetchDataRecord'])->name('data_record');
