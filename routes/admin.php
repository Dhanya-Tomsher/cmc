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
use App\Http\Controllers\Admin\ProcedureController;
use App\Http\Controllers\Admin\FormsController;

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
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
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
    Route::post('caretaker.blacklist', [CaretakerController::class, 'getCaretakerBlackList'])->name('caretaker.blacklist');
    Route::get('caretaker.blacklisted', [CaretakerController::class, 'getCaretakerBlackListing'])->name('caretaker.blacklisted');

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
    Route::post('cat.check-availability', [CatController::class, 'checkCatIdAvailability'])->name('cat.check-availability');
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
   
    Route::get('get-hospital-invoice/{invoice}', [InvoiceController::class, 'getHospitalInvoiceDetails'])->name('get-hospital-invoice');
    Route::post('update-invoice-data', [InvoiceController::class, 'updateInvoice'])->name('update-invoice-data');
    
    Route::get('get-hotel-invoice/{invoice}', [InvoiceController::class, 'getHotelInvoiceDetails'])->name('get-hotel-invoice');
    Route::get('/generatepdf/{id}/{type}', [InvoiceController::class, 'generateInvoicePDF'])->name('generate-pdf');

    Route::get('hote', [HotelAppointmentsController::class, 'index'])->name('hote.index');
    Route::get('hote/create', [HotelAppointmentsController::class, 'create'])->name('hote.create');
    Route::get('hote/view', [HotelAppointmentsController::class, 'view'])->name('hote.view');
    Route::get('hote/edit', [HotelAppointmentsController::class, 'edit'])->name('hote.edit');
    Route::get('hote/search', [HotelAppointmentsController::class, 'search'])->name('hote.search');
    Route::post('hote/store', [HotelAppointmentsController::class, 'store'])->name('hote.store');
    Route::post('hote/update', [HotelAppointmentsController::class, 'update'])->name('hote.update');

    Route::get('hrooms', [HotelroomsController::class, 'index'])->name('hrooms.index');
    Route::get('hrooms/create', [HotelroomsController::class, 'create'])->name('hrooms.create');
    Route::get('hrooms/view/{hrooms}', [HotelroomsController::class, 'view'])->name('hrooms.view');
    Route::get('hrooms/edit/{hrooms}', [HotelroomsController::class, 'edit'])->name('hrooms.edit');
    Route::get('hrooms/search', [HotelroomsController::class, 'search'])->name('hrooms.search');
    Route::post('hrooms/store', [HotelroomsController::class, 'store'])->name('hrooms.store');
    Route::post('hrooms/update/{hrooms}', [HotelroomsController::class, 'update'])->name('hrooms.update');
    Route::post('rooms.list', [HotelroomsController::class, 'getRoomsList'])->name('rooms.list');
    Route::post('hrooms/delete', [HotelroomsController::class, 'delete'])->name('hrooms.delete');

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
    Route::post('caretaker-cats-details',[HospitalAppointmentsController::class,'getCaretakerCats'])->name('get-caretaker-cats');

    Route::get('cat-search',[HospitalAppointmentsController::class,'searchCat'])->name('ajax-autocomplete-cat-search');
    Route::post('cat-details',[HospitalAppointmentsController::class,'getCatDetails'])->name('get-cat');

    Route::get('procedure-search',[HospitalAppointmentsController::class,'searchProcedure'])->name('ajax-autocomplete-procedure-search');
    Route::post('save-appointment-details',[HospitalAppointmentsController::class,'saveAppointmentDetails'])->name('save-appointment');
    Route::post('update-appointment-details',[HospitalAppointmentsController::class,'updateAppointmentDetails'])->name('update-appointment');

    Route::get('get-appointments',[HospitalAppointmentsController::class,'getHospitalAppointments'])->name('get-appointments');

    Route::post('get-selected-slots',[HospitalAppointmentsController::class,'getSelectedSlots'])->name('get-selected-slots');
    Route::post('get-selected-edit-slots',[HospitalAppointmentsController::class,'getSelectedEditSlots'])->name('get-selected-edit-slots');
    Route::post('get-vets-ondate',[HospitalAppointmentsController::class,'getVetsOnDate'])->name('get-vets-ondate');
    Route::get('get-scheduled-vets',[VetscheduleController::class,'getScheduledVets'])->name('get-scheduled-vets');

    Route::get('day-appointments',[HospitalAppointmentsController::class,'getDayAppointments'])->name('day-appointments');
    Route::post('ajax-getday-appointments',[HospitalAppointmentsController::class,'ajaxGetDayAppointments'])->name('ajax-getday-appointments');

    Route::get('hotel-appointments',[HotelAppointmentsController::class,'getHotelAppointments'])->name('hotel-appointments');
    Route::get('get-hotel-schedules',[HotelAppointmentsController::class,'getHotelSchedules'])->name('get-hotel-schedules');
    Route::post('get-available-rooms',[HotelAppointmentsController::class,'getAvailableRooms'])->name('get-available-rooms');
    Route::post('save-hotel-booking',[HotelAppointmentsController::class,'saveHotelBooking'])->name('save-hotel-booking');
    Route::post('update-hotel-booking',[HotelAppointmentsController::class,'updateHotelBooking'])->name('update-hotel-booking');
    Route::post('booking.edit', [HotelAppointmentsController::class, 'editBookings'])->name('booking.edit');
    Route::post('get-available-edit-rooms',[HotelAppointmentsController::class,'getAvailableEditRooms'])->name('get-available-edit-rooms');
    Route::post('hotel-payment-status',[HotelAppointmentsController::class,'changePaymentStatus'])->name('hotel-payment-status');

    Route::get('manage-hospital-appointments',[HospitalAppointmentsController::class,'manageHospitalAppointments'])->name('manage-hospital-appointments');
    // Route::get('appointment/list', [HospitalAppointmentsController::class, 'getAppointmentList'])->name('appointment.list');
    Route::post('appointment.list', [HospitalAppointmentsController::class, 'getAppointmentsList'])->name('appointment.list');
    Route::post('appointment.delete', [HospitalAppointmentsController::class, 'deleteAppointment'])->name('appointment.delete');
    Route::post('appointment.view', [HospitalAppointmentsController::class, 'getAppointmentsDetails'])->name('appointment.view');
    Route::post('appointment.edit', [HospitalAppointmentsController::class, 'editAppointments'])->name('appointment.edit');
    Route::post('hospital-payment-status',[HospitalAppointmentsController::class,'changePaymentStatus'])->name('hospital-payment-status');

    Route::get('manage-hotel-bookings',[HotelAppointmentsController::class,'manageHotelBookings'])->name('manage-hotel-bookings');
    Route::post('booking.list', [HotelAppointmentsController::class, 'getBookingList'])->name('booking.list');
    Route::post('booking.delete', [HotelAppointmentsController::class, 'deleteBooking'])->name('booking.delete');
    Route::post('booking.view', [HotelAppointmentsController::class, 'getBookingDetails'])->name('booking.view');

    
    Route::get('procedure', [ProcedureController::class, 'index'])->name('procedure.index');
    Route::post('procedure/store', [ProcedureController::class, 'store'])->name('procedure.store');
    Route::post('procedure/delete', [ProcedureController::class, 'delete'])->name('procedure.delete');
    Route::post('procedure.list', [ProcedureController::class, 'getProcedureList'])->name('procedure.list');

    Route::get('forms', [FormsController::class, 'index'])->name('forms.index');
    Route::post('forms/delete', [FormsController::class, 'delete'])->name('form.delete');
    Route::get('form/create', [FormsController::class, 'create'])->name('form.create');
    Route::get('form/view/{form}', [FormsController::class, 'view'])->name('form.view');
    Route::get('form/edit/{form}', [FormsController::class, 'edit'])->name('form.edit');
    Route::post('form/store', [FormsController::class, 'store'])->name('form.store');

    Route::get('custom-forms', [FormsController::class, 'customFormsList'])->name('custom-forms');
    Route::post('generate-custom-form', [FormsController::class, 'generateCustomForm'])->name('generate-custom-form');
    Route::post('custom-forms-list', [FormsController::class, 'customFormsListing'])->name('custom-forms-list');
    Route::post('custom-form.delete', [FormsController::class, 'customFormDelete'])->name('custom-form.delete');
    Route::get('custom-form/view/{cid}', [FormsController::class, 'viewCustom'])->name('custom-form.view');
    Route::post('signaturepad',[FormsController::class, 'signatureUpload'])->name('signaturepad.upload');

    Route::get('custom-signature/{cid}', [FormsController::class, 'customSignature'])->name('custom-signature');

    Route::get('dashboard-counts', [DashboardController::class, 'countsApi'])->name('dashboard-counts');

    Route::get('cats-count', [DashboardController::class, 'catsCountApi'])->name('cats-count');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
