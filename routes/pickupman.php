<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Pickupman\PickupmanController;
use App\Models\Pickupman;

Route::group(['prefix' => 'pickupman', 'middleware' => ['pickupmanMiddleware']], function () {
    Route::get('home', [PickupmanController::class, 'dashboard'])->name('pickupman.home');
    Route::get('parcels', [PickupmanController::class, 'parcels'])->name('pickupman.percels');
    Route::get('pending-parcels', [PickupmanController::class, 'pendingParcels'])->name('pickupman.parcel.pending');
    Route::post('status-udpate', [PickupmanController::class, 'statusupdate'])->name('pickupman.parcel.statusupdate');
    Route::get('pickupman-todays-percel', [PickupmanController::class, 'todaysPercel'])->name('pickupman.today.percel');
    Route::get('pickupman-todays-percel-pending', [PickupmanController::class, 'todaysPercel'])->name('pickupman.today.parcel.pending');
    Route::get('pickupman-todays-percel-picked', [PickupmanController::class, 'todaysPercel'])->name('pickupman.today.parcel.picked');
    Route::get('total_parcel_without_pending', [PickupmanController::class, 'withOutPending'])->name('total.parcel.without_pending');

    Route::get('assignable-parcels', [PickupmanController::class, 'assignable'])->name('pickupman.assignable');

    Route::post('assign-me', [PickupmanController::class, 'assignme'])->name('pickupman.assignme');
    Route::post('assign-me-multiple', [PickupmanController::class, 'multipleAssignme'])->name('pickupman.multiple.assignme');
    Route::post('multiple-pickup', [PickupmanController::class, 'multiplePickup'])->name('pickupman.multiplepickup');
    Route::get('pickupman-payment-invoices',[PickupmanController::class,'paymentInvoices'])->name('pickupman.payment.invoice');
    Route::get('pickupman-payment-invoices/{id}',[PickupmanController::class,'paymentInvoiceDetails'])->name('pickupman.payment.invoice.details');
    Route::get('pickupman-payment-invoices/download/{id}',[PickupmanController::class,'paymentInvoiceDownload'])->name('pickupman.payment.invoice.download');
    Route::get('profile', [PickupmanController::class, 'profile'])->name('pickupman.profile');
});
