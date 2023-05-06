<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CaretakerController;
use App\Http\Controllers\Admin\DashboardController;
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

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard-caretaker-search',[DashboardController::class,'searchCaretaker'])->name('dashboard-caretaker-search');
    Route::get('dashboard-cat-search',[DashboardController::class,'searchCat'])->name('dashboard-cat-search');
    Route::post('dashboard-caretaker-list', [DashboardController::class, 'getCaretakerList'])->name('dashboard-caretaker-list');

    Route::get('caretaker', [CaretakerController::class, 'index'])->name('caretaker.index');
    Route::get('caretaker/create', [CaretakerController::class, 'create'])->name('caretaker.create');
    Route::get('caretaker/view/{caretaker}', [CaretakerController::class, 'view'])->name('caretaker.view');
    Route::get('caretaker/edit/{caretaker}', [CaretakerController::class, 'edit'])->name('caretaker.edit');
    Route::post('caretaker/store', [CaretakerController::class, 'store'])->name('caretaker.store');
    Route::post('caretaker/update', [CaretakerController::class, 'update'])->name('caretaker.update');
    Route::post('caretaker.list', [CaretakerController::class, 'getCaretakerList'])->name('caretaker.list');

    Route::get('cat', [CatController::class, 'index'])->name('cat.index');
    Route::get('cat/create', [CatController::class, 'create'])->name('cat.create');
    Route::get('cat/view/{cat}', [CatController::class, 'view'])->name('cat.view');
    Route::get('cat/edit/{cat}', [CatController::class, 'edit'])->name('cat.edit');
    Route::get('cat/search', [CatController::class, 'search'])->name('cat.search');
    Route::post('cat/store', [CatController::class, 'store'])->name('cat.store');
    Route::post('cat/update', [CatController::class, 'update'])->name('cat.update');
    Route::post('cat.list', [CatController::class, 'getCatsList'])->name('cat.list');
    Route::post('cat/update-pic', [CatController::class, 'updateImage'])->name('cat.update-pic');
    Route::get('cat/journal/{cat}', [CatController::class, 'journal'])->name('cat.journal');
    Route::post('cat/journal/details', [CatController::class, 'getJournalData'])->name('cat.journal-data');
    Route::post('medical-history.delete', [CatController::class, 'deleteMedicalHistory'])->name('delete-medical-history');
    Route::post('medical-history.store', [CatController::class, 'storeMedicalHistory'])->name('medical-history.store');
    Route::post('journal-details.store', [CatController::class, 'storeJournalDetails'])->name('journal-details.store');
    Route::post('journal-data.delete', [CatController::class, 'deleteJournalData'])->name('delete-journal-data');
    Route::post('virus-test.store', [CatController::class, 'storeVirusTest'])->name('virus-test.store');
    Route::post('virus-test.delete', [CatController::class, 'deleteVirusTest'])->name('delete-virus-test');

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
    Route::get('get-vet-schedules/{vet_id}',[VetscheduleController::class,'getVetSchedules'])->name('get-vet-schedule');
    Route::post('save-vet-schedule',[VetscheduleController::class,'saveVetSchedule'])->name('save-vet-schedule');
    Route::post('vet.list', [VetController::class, 'getVetList'])->name('vet.list');

    Route::get('hospital-appointments',[HospitalAppointmentsController::class,'getAppointments'])->name('hospital-appointments');
    Route::get('caretaker-search',[HospitalAppointmentsController::class,'searchCaretaker'])->name('ajax-autocomplete-caretaker-search');
    Route::post('caretaker-details',[HospitalAppointmentsController::class,'getCaretakerDetails'])->name('get-caretaker');

    Route::get('cat-search',[HospitalAppointmentsController::class,'searchCat'])->name('ajax-autocomplete-cat-search');
    Route::post('cat-details',[HospitalAppointmentsController::class,'getCatDetails'])->name('get-cat');

    Route::get('procedure-search',[HospitalAppointmentsController::class,'searchProcedure'])->name('ajax-autocomplete-procedure-search');
    Route::post('save-appointment-details',[HospitalAppointmentsController::class,'saveAppointmentDetails'])->name('save-appointment');

    Route::get('get-appointments',[HospitalAppointmentsController::class,'getHospitalAppointments'])->name('get-appointments');

    Route::post('get-selected-slots',[HospitalAppointmentsController::class,'getSelectedSlots'])->name('get-selected-slots');
    
    Route::get('get-scheduled-vets',[VetscheduleController::class,'getScheduledVets'])->name('get-scheduled-vets');

    Route::get('day-appointments',[HospitalAppointmentsController::class,'getDayAppointments'])->name('day-appointments');
    Route::post('ajax-getday-appointments',[HospitalAppointmentsController::class,'ajaxGetDayAppointments'])->name('ajax-getday-appointments');

    Route::get('hotel-appointments',[HotelAppointmentsController::class,'getHotelAppointments'])->name('hotel-appointments');
    Route::get('get-hotel-schedules',[HotelAppointmentsController::class,'getHotelSchedules'])->name('get-hotel-schedules');
    Route::post('get-available-rooms',[HotelAppointmentsController::class,'getAvailableRooms'])->name('get-available-rooms');
    Route::post('save-hotel-booking',[HotelAppointmentsController::class,'saveHotelBooking'])->name('save-hotel-booking');

    Route::get('manage-hospital-appointments',[HospitalAppointmentsController::class,'manageHospitalAppointments'])->name('manage-hospital-appointments');
    // Route::get('appointment/list', [HospitalAppointmentsController::class, 'getAppointmentList'])->name('appointment.list');
    Route::post('appointment.list', [HospitalAppointmentsController::class, 'getAppointmentsList'])->name('appointment.list');
    Route::post('appointment.delete', [HospitalAppointmentsController::class, 'deleteAppointment'])->name('appointment.delete');

    Route::get('manage-hotel-bookings',[HotelAppointmentsController::class,'manageHotelBookings'])->name('manage-hotel-bookings');
    Route::post('booking.list', [HotelAppointmentsController::class, 'getBookingList'])->name('booking.list');
    Route::post('booking.delete', [HotelAppointmentsController::class, 'deleteBooking'])->name('booking.delete');
    
    
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
