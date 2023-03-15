<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\DeliverymanController;


Route::group(['prefix' => 'deliveryman', 'middleware' => ['deliverymanMiddleware']], function () {
    Route::get('home', [DeliverymanController::class, 'dashboard'])->name('deliveryman.home');
    Route::get('parcels', [DeliverymanController::class, 'parcels'])->name('deliveryman.percels');
    Route::get('pending-parcels', [DeliverymanController::class, 'pendingParcels'])->name('deliveryman.parcel.pending');
    Route::post('status-udpate', [DeliverymanController::class, 'statusupdate'])->name('deliveryman.parcel.statusupdate');
    Route::get('deliveryman-todays-percel', [DeliverymanController::class, 'todaysPercel'])->name('deliveryman.today.percel');
    Route::post('parcel-partial-return', [DeliverymanController::class, 'partialReturn'])->name('deliveryman.partial.return');
    Route::get('assignable-parcels', [DeliverymanController::class, 'assignable'])->name('deliveryman.assignable');
    Route::post('assign-me', [DeliverymanController::class, 'assignme'])->name('deliveryman.assignme');

    Route::get('deliveryman-payment-invoices', [DeliverymanController::class, 'paymentInvoices'])->name('deliveryman.payment.invoice');
    Route::get('deliveryman-payment-invoices/{id}', [DeliverymanController::class, 'paymentInvoiceDetails'])->name('deliveryman.payment.invoice.details');
    Route::get('deliveryman-payment-invoices/download/{id}', [DeliverymanController::class, 'paymentInvoiceDownload'])->name('deliveryman.payment.invoice.download');

    Route::get('profile', [DeliverymanController::class, 'profile'])->name('deliveryman.profile');


    Route::get('location-update',[DeliverymanController::class,'locationUpdate'])->name('location.update');
});
