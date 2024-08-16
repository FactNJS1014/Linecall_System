<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeakController;
use App\Http\Controllers\RootController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\DataformController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PDFController;

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

//Route::get('/approve', function () {
//    return view('apr_linecall');
//})->name('approve');

Route::get('/rankmaster', function () {
    return view('RankApp');
})->name('rankmaster');



Route::get('/approve', function () {
    return view('apr_linecall');
})->name('approve');

Route::get('/reports', function () {
    return view('reports');
})->name('reports');

Route::get('/ProblemUpdate', function () {
    return view('Updatedata.ProblemUpdate');
})->name('PrbUpdate');

Route::get('/WhyUpdate', function () {
    return view('Updatedata.fiveWhy');
})->name('whyUpdate');


//Route::get('/images_upload',[ImageController::class , 'index'])->name('images-upload');

//บันทึกข้อมูล Leak and Root 5 Why
Route::post('/LeakRecord', [LeakController::class, 'recordLeak'])->name('recordLeak');
Route::post('/record/data', [ProblemController::class, 'recordData'])->name('recordData');
Route::post('/Root/data', [RootController::class, 'recordRoot'])->name('recordRoot');
Route::post('/master/data', [MasterController::class, 'insertmaster'])->name('master');
//update data
Route::post('/Leak/update', [LeakController::class, 'updateLeak'])->name('updateLeak');
Route::post('/update/data', [ProblemController::class, 'updateData'])->name('updateData');
Route::post('/Root/update', [RootController::class, 'updateRoot'])->name('updateRoot');


//fetch data
Route::get('/showform01', [DataformController::class, 'fetchDataRec01'])->name('data_first');

Route::get('/showform02', [DataformController::class, 'fetchDataRec02'])->name('data_second');
Route::get('/showdata/record', [DataformController::class, 'fetchDataRecord'])->name('data_record');
Route::get('/showdata/getedit1', [DataformController::class, 'getDataEditForm1'])->name('get_editform1');
Route::get('/showdata/getedit2', [DataformController::class, 'getDataEditForm2'])->name('get_editform2');
Route::get('/showdata/report', [DataformController::class, 'fetchDataReport'])->name('data.report');
Route::get('/masterdata', [MasterController::class, 'fetchDataMaster'])->name('data.master');
Route::get('/get/customer', [DataformController::class, 'getCustomer'])->name('getCustomer');
Route::get('/get/workorder', [DataformController::class, 'getWorkOrder'])->name('getWorkOrder');
Route::get('/get/model', [DataformController::class, 'getModel'])->name('getModel');
Route::get('/get/process', [DataformController::class, 'getProcess'])->name('getProcess');
Route::get('/get/ngcode', [DataformController::class, 'getNgCode'])->name('getNgCode');
Route::get('/get/ngcode2', [DataformController::class, 'getNgCode2']);
Route::get('/get/master', [DataformController::class, 'getMaster']);
Route::get('/get/user', [DataformController::class, 'getUserWeb'])->name('getUserWeb');
Route::get('/get/showuser', [DataformController::class, 'showUsername'])->name('getUsershow');
Route::get('/get/approve', [ProblemController::class, 'ApproveData'])->name('getApprove');
Route::get('/get/lvapp', [ProblemController::class, 'ApproveOfLevel'])->name('getlevelapp');
Route::get('/get/compare', [DataformController::class, 'compareLevel'])->name('compareLevel');
Route::get('/get/report', [DataformController::class, 'DataReport'])->name('datareport');


//Delete data linecall
Route::get('/delete/data', [DataformController::class, 'DeleteData'])->name('deletedata');
Route::post('/delete/img', [DataformController::class, 'DeleteImg'])->name('deleteimg');
//reject data
Route::post('/get/reject', [DataformController::class, 'getRejected'])->name('get.reject');


//Show PDF Document
Route::get('/show/pdf/{filename}', [PDFController::class, 'ShowDocumentFile'])->name('show.pdf');

//Alarm Notification
Route::get('/alarm/notification', [DataformController::class, 'AlarmNotification'])->name('alarm.notification');
