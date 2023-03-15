<?php

use App\Http\Controllers\Frontend\Agent\AgentController;
use App\Http\Controllers\Frontend\Agent\AgentParcelManageController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'agent', 'middleware' => ['agentMiddleware']], function () {
    Route::get('/home', [AgentController::class, 'index'])->name('agent.home');
    Route::get('agent-todays-percel', [AgentController::class, 'todaysPercel'])->name('agent.today.percel');;
    Route::get('parcel-cancel/{parcel_id}', [AgentController::class, 'parcelCancel']);
    Route::get('parcel-in-details/{id}', [AgentController::class, 'parceldetails']);
    Route::post('parcel-track/', [AgentController::class, 'parceltrack']);
    Route::get('profile', [AgentController::class, 'profile'])->name('agent.profile');

    // Merchant Percel Management
    Route::group(['prefix' => 'percel'], function () {
        Route::get('percel-create', [AgentParcelManageController::class, 'create'])->name('agent.percel.create');
        Route::post('percel-store', [AgentParcelManageController::class, 'store'])->name('agent.percel.store');
        Route::get('percel-manage/{slug}', [AgentParcelManageController::class, 'index'])->name('agent.percel.index');
        Route::get('parcel-cancel/{parcel_id}', [AgentParcelManageController::class, 'parcelCancel'])->name('agent.percel.cancel');
        Route::get('parcel-details/{id}', [AgentParcelManageController::class, 'show'])->name('agent.parcel.show');
        Route::get('parcel-edit/{id}', [AgentParcelManageController::class, 'edit'])->name('agent.percel.edit');
        Route::post('parcel-update', [AgentParcelManageController::class, 'update'])->name('agent.percel.update');
        Route::get('parcel-delete/{id}', [AgentParcelManageController::class, 'destroy'])->name('agent.percel.delete');

        Route::post('percel-manage/select-update', [AgentParcelManageController::class, 'selectUpdate'])->name('agent.percel.manage.select.update');


        //import parcel route
        Route::get('import-percel', [AgentParcelManageController::class, 'importParcel'])->name('agent.import.parcel');
        Route::post('import-percel-read', [AgentParcelManageController::class, 'importParcelRead'])->name('agent.import.parcel.read');
        Route::post('import-percel-store', [AgentParcelManageController::class, 'storeImportParcel'])->name('agent.import.parcel.store');

        // multiple percel assign to deliveryman
        Route::post('percel-assign-to-deliveryman', [AgentParcelManageController::class, 'deliverymanAssignMultiple'])->name('agent.percel.manage.assign.deliveryman.multi');
        // multiple percel assign to pickupman
        Route::post('percel-assign-to-pickupman', [AgentParcelManageController::class, 'pickupmanAssignMultiple'])->name('agent.percel.manage.assign.pickupman.multi');
        // multiple percel assign to pickupman
        Route::post('percel-assign-to-agent', [AgentParcelManageController::class, 'agentAssignMultiple'])->name('agent.percel.manage.assign.agent.multi');
        // generate lebel
        Route::post('multiple-label-genarate', [AgentParcelManageController::class, 'generateMultiLabel'])->name('agent.percel.manage.generate.multi.label');
        Route::get('label-genarate/{id}', [AgentParcelManageController::class, 'generateLabel'])->name('agent.percel.manage.generate.label');

        // single assign
        Route::post('/percel-deliveryman-assign', [AgentParcelManageController::class, 'deliverymanAssign'])->name('agent.percel.deliveryman.assign');
        Route::post('/percel-pickupman-assign', [AgentParcelManageController::class, 'pickupmanAssign'])->name('agent.percel.pickupman.assign');
        Route::post('/percel-agent-assign', [AgentParcelManageController::class, 'agentAssign'])->name('agent.percel.agent.assign');

        // partial return
        Route::post('parcel-partial-return', [AgentParcelManageController::class, 'partialReturn'])->name('agent.parcel.partial.return');


        // assign me
        Route::get('assignable',[AgentParcelManageController::class,'assignable'])->name('agent.paracel.assignable');
        Route::post('assign-me', [AgentParcelManageController::class, 'assignme'])->name('agent.assignme');
        Route::post('assign-me-multiple', [AgentParcelManageController::class, 'multipleAssignme'])->name('agent.multiple.assignme');

    });


    Route::get('agent-payment-invoices', [AgentController::class, 'paymentInvoices'])->name('agent.payment.invoice');
    Route::get('agent-payment-invoices/{id}', [AgentController::class, 'paymentInvoiceDetails'])->name('agent.payment.invoice.details');
    
    // percel invoice
    Route::get('/percel-invoice/{id}', [AgentParcelManageController::class, 'invoice'])->name('agent.percel.invioce');
    
    //status update
    Route::post('deliver-percel',[AgentParcelManageController::class,'deliveryStatus'])->name('agent.deliver.percel');

    // Report Management
    Route::group(['prefix' => 'report'], function () {
        Route::get('/deliveryman', [AgentController::class, 'deliverymanReport'])->name('agent.report.deliveryman');
        Route::get('/pickupman', [AgentController::class, 'pickupmanReport'])->name('agent.report.pickupman');
    });
});
