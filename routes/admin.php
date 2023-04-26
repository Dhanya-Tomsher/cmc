<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CaretakerController;
use App\Http\Controllers\Admin\CatController;
use App\Http\Controllers\Admin\VetController;
use App\Http\Controllers\Admin\VetscheduleController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\HospitalAppointmentsController;
use App\Http\Controllers\Admin\HotelAppointmentsController;
use App\Http\Controllers\Admin\HotelroomsController;

//Route::prefix('admin')->group(function () {
//    Route::middleware(['auth', 'auth.session'])->group(function () {
// Route::get('/', function () {
//     return redirect()->route('login');
// });


Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::namespace('Auth')->group(function () {

        // Route::get('/', function () {
        //     return redirect()->route('login');
        // });

        Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
    });
    //will do later
    /*Route::middleware('admin')->group(function(){
    Route::get('dashboard',[HomeController::class,'index'])->name('dashboard');
});*/

    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('caretaker', [CaretakerController::class, 'index'])->name('caretaker.index');
    Route::get('caretaker/create', [CaretakerController::class, 'create'])->name('caretaker.create');
    Route::get('caretaker/view/{caretaker}', [CaretakerController::class, 'view'])->name('caretaker.view');
    Route::get('caretaker/edit', [CaretakerController::class, 'edit'])->name('caretaker.edit');
    Route::post('caretaker/store', [CaretakerController::class, 'store'])->name('caretaker.store');
    Route::post('caretaker/update', [CaretakerController::class, 'update'])->name('caretaker.update');

    Route::get('cat', [CatController::class, 'index'])->name('cat.index');
    Route::get('cat/create', [CatController::class, 'create'])->name('cat.create');
    Route::get('cat/view', [CatController::class, 'view'])->name('cat.view');
    Route::get('cat/edit', [CatController::class, 'edit'])->name('cat.edit');
    Route::get('cat/search', [CatController::class, 'search'])->name('cat.search');
    Route::post('cat/store', [CatController::class, 'store'])->name('cat.store');
    Route::post('cat/update', [CatController::class, 'update'])->name('cat.update');

    Route::get('invoice', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::get('invoice/view', [InvoiceController::class, 'view'])->name('invoice.view');
    Route::get('invoice/edit', [InvoiceController::class, 'edit'])->name('invoice.edit');
    Route::get('invoice/search', [InvoiceController::class, 'search'])->name('invoice.search');
    Route::post('invoice/store', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::post('invoice/update', [InvoiceController::class, 'update'])->name('invoice.update');

    Route::get('hote', [HotelAppointmentsController::class, 'index'])->name('hote.index');
    Route::get('hote/create', [HotelAppointmentsController::class, 'create'])->name('hote.create');
    Route::get('hote/view', [HotelAppointmentsController::class, 'view'])->name('hote.view');
    Route::get('hote/edit', [HotelAppointmentsController::class, 'edit'])->name('hote.edit');
    Route::get('hote/search', [HotelAppointmentsController::class, 'search'])->name('hote.search');
    Route::post('hote/store', [HotelAppointmentsController::class, 'store'])->name('hote.store');
    Route::post('hote/update', [HotelAppointmentsController::class, 'update'])->name('hote.update');

    Route::get('hrooms', [HotelroomsController::class, 'index'])->name('hrooms.index');
    Route::get('hrooms/create', [HotelroomsController::class, 'create'])->name('hrooms.create');
    Route::get('hrooms/view', [HotelroomsController::class, 'view'])->name('hrooms.view');
    Route::get('hrooms/edit', [HotelroomsController::class, 'edit'])->name('hrooms.edit');
    Route::get('hrooms/search', [HotelroomsController::class, 'search'])->name('hrooms.search');
    Route::post('hrooms/store', [HotelroomsController::class, 'store'])->name('hrooms.store');
    Route::post('hrooms/update', [HotelroomsController::class, 'update'])->name('hrooms.update');

    Route::get('hosp', [HospitalAppointmentsController::class, 'index'])->name('hosp.index');
    Route::get('hosp/create', [HospitalAppointmentsController::class, 'create'])->name('hosp.create');
    Route::get('hosp/view', [HospitalAppointmentsController::class, 'view'])->name('hosp.view');
    Route::get('hosp/edit', [HospitalAppointmentsController::class, 'edit'])->name('hosp.edit');
    Route::get('hosp/search', [HospitalAppointmentsController::class, 'search'])->name('hosp.search');
    Route::post('hosp/store', [HospitalAppointmentsController::class, 'store'])->name('hosp.store');
    Route::post('hosp/update', [HospitalAppointmentsController::class, 'update'])->name('hosp.update');


    Route::get('vet', [VetController::class, 'index'])->name('vet.index');
    Route::get('vet/create', [VetController::class, 'create'])->name('vet.create');
    Route::get('vet/schedule', [VetController::class, 'schedule'])->name('vet.schedule');
    Route::get('vet/view/{vet}', [VetController::class, 'view'])->name('vet.view');
    Route::get('vet/edit/{vet}', [VetController::class, 'edit'])->name('vet.edit');
    Route::get('vet/search', [VetController::class, 'search'])->name('vet.search');
    Route::post('vet/store', [VetController::class, 'store'])->name('vet.store');
    Route::post('vet/update/{vet}', [VetController::class, 'update'])->name('vet.update');
    Route::get('vetschedule', [VetscheduleController::class, 'index'])->name('vetschedule.index');
    Route::post('vetschedule/action', [VetscheduleController::class, 'action'])->name('vetschedule.action');


    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
