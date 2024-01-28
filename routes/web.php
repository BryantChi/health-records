<?php

use Illuminate\Support\Facades\Route;

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

Route::any('health-records/store', [App\Http\Controllers\HealthRecordsInfoController::class, 'store'])->name('health-records.store');
Route::any('health-records/reports', [App\Http\Controllers\HealthRecordsInfoController::class, 'index'])->name('health-records.reports');
Route::any('health-records/edit/{id}', [App\Http\Controllers\HealthRecordsInfoController::class, 'edit'])->name('health-records.edit');
Route::any('health-records/update', [App\Http\Controllers\HealthRecordsInfoController::class, 'update'])->name('health-records.update');
