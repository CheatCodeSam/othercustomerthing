<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotesController;




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

Route::resource('/customer', CustomerController::class);
Route::resource('/manufacturer', ManufacturerController::class);
Route::resource('/equipment', EquipmentController::class);
Route::resource('/invoice', InvoiceController::class);
Route::resource('/note', NotesController::class);


Route::delete('/invoice/{invoiceID}/{itemID}', [InvoiceController::class, 'deleteItem'])->name('equipment.deleteItem');
Route::post('/invoice/{invoiceID}/{itemID}', [InvoiceController::class, 'addItem'])->name('equipment.addItem');


Route::get('/', function () {
    return view('welcome');
});
