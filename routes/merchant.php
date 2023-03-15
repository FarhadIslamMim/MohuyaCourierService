<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Merchant\MerchantController;
use App\Http\Controllers\Frontend\Merchant\MerchantParcelController;



Route::group(['prefix' => 'merchant', 'middleware' => ['merchantMiddleware']], function () {
    Route::get('/home', [MerchantController::class, 'index'])->name('merchant.home');
    Route::get('today/parcels', [MerchantController::class, 'today_parcels']);
    Route::get('parcel-cancel/{parcel_id}', [MerchantController::class, 'parcelCancel']);
    Route::get('parcel-in-details/{id}', [MerchantController::class, 'parceldetails']);
    Route::get('parcel-edit/{id}', [MerchantController::class, 'parceledit']);
    Route::post('update-parcel', [MerchantController::class, 'parcelupdate']);
    Route::post('parcel-track/', [MerchantController::class, 'parceltrack']);
    Route::get('get-payments', [MerchantController::class, 'payments']);
    Route::get('parcels', [MerchantController::class, 'parcels'])->name('marchant.percels');
    Route::get('profile', [MerchantController::class, 'profile'])->name('merchant.profile');

    Route::get('invoice/{id}', [MerchantParcelController::class, 'invoice'])->name('merchant.invoice');


    Route::get('merchant-payment-invoices', [MerchantController::class, 'paymentInvoices'])->name('merchant.payment.invoice');
    Route::get('merchant-payment-invoices/{id}', [MerchantController::class, 'paymentInvoiceDetails'])->name('merchant.payment.invoice.details');

    // Merchant Percel Management
    Route::group(['prefix' => 'percel'], function () {
        Route::get('/percel-create', [MerchantParcelController::class, 'create'])->name('merchant.percel.create');
        Route::post('/percel-store', [MerchantParcelController::class, 'store'])->name('merchant.percel.store');
        Route::get('/parcel-cancel/{parcel_id}', [MerchantParcelController::class, 'parcelCancel'])->name('merchant.percel.cancel');
        Route::get('/parcel-details/{id}', [MerchantParcelController::class, 'show'])->name('merchant.parcel.show');
        Route::get('/parcel-edit/{id}', [MerchantParcelController::class, 'edit'])->name('merchant.percel.edit');
        Route::post('/parcel-update', [MerchantParcelController::class, 'update'])->name('merchant.percel.update');
        Route::get('/parcel-delete/{id}', [MerchantParcelController::class, 'destroy'])->name('merchant.percel.delete');

        // import order
        Route::get('/parcel-import', [MerchantParcelController::class, 'import'])->name('merchant.percel.import');
        Route::post('/parcel-import-temp-store', [MerchantParcelController::class, 'importParcelRead'])->name('merchant.percel.import.store');
        Route::post('/parcel-import-store', [MerchantParcelController::class, 'importParcel'])->name('merchant.percel.import.store.data');
    });
});
