<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Superadmin\Accounts\AccountController;
use App\Http\Controllers\Backend\Superadmin\Accounts\DeliverymanExpenseController;
use App\Http\Controllers\Backend\Superadmin\Accounts\EmployeeAdvanceSalaryController;
use App\Http\Controllers\Backend\Superadmin\Accounts\EmployeeSalaryController;
use App\Http\Controllers\Backend\Superadmin\Accounts\ExpenseCategoryController;
use App\Http\Controllers\Backend\Superadmin\Accounts\ExpenseManageController;
use App\Http\Controllers\Backend\Superadmin\Accounts\IncomeCategoryController;
use App\Http\Controllers\Backend\Superadmin\Accounts\IncomeManageController;
use App\Http\Controllers\Backend\Superadmin\Accounts\PickupmanExpenseController;
use App\Http\Controllers\Backend\Superadmin\AgentManageController;
use App\Http\Controllers\Backend\Superadmin\AgentPaymentController;
use App\Http\Controllers\Backend\Superadmin\AreaManageController;
use App\Http\Controllers\Backend\Superadmin\Areas\AreaController;
use App\Http\Controllers\Backend\Superadmin\Areas\DistrictController;
use App\Http\Controllers\Backend\Superadmin\Areas\DivisionController;
use App\Http\Controllers\Backend\Superadmin\Areas\ThanaController;
use App\Http\Controllers\Backend\Superadmin\AttendenceManageController;
use App\Http\Controllers\Backend\Superadmin\DeliveryChargeController;
use App\Http\Controllers\Backend\Superadmin\DeliverymanManageController;
use App\Http\Controllers\Backend\Superadmin\DeliverymanPaymentController;
use App\Http\Controllers\Backend\Superadmin\EmployeeManageController;
use App\Http\Controllers\Backend\Superadmin\FeatureController;
use App\Http\Controllers\Backend\Superadmin\HubAreaController;
use App\Http\Controllers\Backend\Superadmin\MerchantManageController;
use App\Http\Controllers\Backend\Superadmin\MerchantPaymentController;
use App\Http\Controllers\Backend\Superadmin\Package\DeliveryChargePackageController;
use App\Http\Controllers\Backend\Superadmin\PercelController;
use App\Http\Controllers\Backend\Superadmin\PickupmanManageController;
use App\Http\Controllers\Backend\Superadmin\PickupmanPaymentController;
use App\Http\Controllers\Backend\Superadmin\ReportManageController;
use App\Http\Controllers\Backend\Superadmin\ServicesController;
use App\Http\Controllers\Backend\Superadmin\SiteSettings;
use App\Http\Controllers\Backend\Superadmin\SliderController;
use App\Http\Controllers\Backend\Superadmin\SmsManageController;
use App\Http\Controllers\Backend\Superadmin\SuperadminController;
use App\Http\Controllers\Backend\Superadmin\UserManageController;
use App\Models\DeliveryChargeHead;

Route::group(['prefix' => 'superadmin', 'middleware' => ['adminMiddleware']], function () {
    Route::get('/dashboard', [SuperadminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/logout', [AuthController::class, 'logOut'])->name('superadmin.logout');
    Route::get('/speed-up', [SuperadminController::class, 'speeUP'])->name('software.speed');

    // Percel Route
    Route::group(['prefix' => 'percel'], function () {
        Route::get('/create', [PercelController::class, 'index'])->name('percel.create')->middleware('permission:parcel_create');
        Route::post('/store', [PercelController::class, 'store'])->name('percel.store');
        Route::get('/percel/edit/{id}', [PercelController::class, 'edit'])->name('percel.edit')->middleware('permission:parcel_edit');
        Route::post('/percel/update', [PercelController::class, 'update'])->name('percel.update');

        // percel manage
        Route::get('/percel-manage/{slug}', [PercelController::class, 'percel'])->name('percel.manage')->middleware('permission:parcel_manage');
        // percel invoice
        Route::get('/percel-invoice/{id}', [PercelController::class, 'invoice'])->name('percel.invioce');
        // percel select update
        Route::post('/percel-manage/select-update', [PercelController::class, 'selectUpdate'])->name('percel.manage.select.update');
        // multiple percel assign to deliveryman
        Route::post('/percel-manage/percel-assign-to-deliveryman', [PercelController::class, 'deliverymanAssignMultiple'])->name('percel.manage.assign.deliveryman.multi');
        // multiple percel assign to pickupman
        Route::post('/percel-manage/percel-assign-to-pickupman', [PercelController::class, 'pickupmanAssignMultiple'])->name('percel.manage.assign.pickupman.multi');
        // multiple percel assign to pickupman
        Route::post('/percel-manage/percel-assign-to-agent', [PercelController::class, 'agentAssignMultiple'])->name('percel.manage.assign.agent.multi');
        // generate lebel
        Route::post('/percel-manage/multiple-label-genarate', [PercelController::class, 'generateMultiLabel'])->name('percel.manage.generate.multi.label');
        Route::get('/percel-manage/label-genarate/{id}', [PercelController::class, 'generateLabel'])->name('percel.manage.generate.label');

        // single assign
        Route::post('/percel-deliveryman-assign', [PercelController::class, 'deliverymanAssign'])->name('percel.deliveryman.assign');
        Route::post('/percel-pickupman-assign', [PercelController::class, 'pickupmanAssign'])->name('percel.pickupman.assign');
        Route::post('/percel-agent-assign', [PercelController::class, 'agentAssign'])->name('percel.agent.assign');

        // partial return
        Route::post('parcel-partial-return', [PercelController::class, 'partialReturn'])->name('parcel.partial.return');

        //import parcel route
        Route::get('import-percel', [SuperadminController::class, 'importParcel'])->name('admin.import.parcel');
        Route::post('import-percel-read', [SuperadminController::class, 'importParcelRead'])->name('admin.import.parcel.read');
        Route::post('import-percel-store', [SuperadminController::class, 'storeImportParcel'])->name('admin.import.parcel.store');


        Route::post('deliver-percel',[PercelController::class,'deliveryStatus'])->name('deliver.percel');
    });

    Route::group(['prefix' => 'delivery-charge'], function () {
        // Delivery Charge package Route
        Route::group(['prefix' => 'dcp'], function () {
            Route::get('delivery-charge-package-create', [DeliveryChargePackageController::class, 'create'])->name('dcp.create');
            Route::post('delivery-charge-package-store', [DeliveryChargePackageController::class, 'store'])->name('dcp.store');
            Route::get('delivery-charge-package-manage', [DeliveryChargePackageController::class, 'index'])->name('dcp.index');
            Route::get('delivery-charge-package-edit/{id}', [DeliveryChargePackageController::class, 'edit'])->name('dcp.edit');
            Route::post('delivery-charge-package-update', [DeliveryChargePackageController::class, 'update'])->name('dcp.update');
            Route::get('delivery-charge-package-delete/{id}', [DeliveryChargePackageController::class, 'destroy'])->name('dcp.delete');
            Route::get('location-setup',[DeliveryChargePackageController::class,'locationSetup'])->name('dcp.location.setup');
        });

        // Delivery Charge Route
        Route::group(['prefix' => 'dc'], function () {
            Route::get('deliverycharge-create', [DeliveryChargeController::class, 'create'])->name('dc.create');
            Route::post('deliverycharge-store', [DeliveryChargeController::class, 'store'])->name('dc.store');
            Route::get('deliverycharge-manage', [DeliveryChargeController::class, 'index'])->middleware('permission:delivery_charge')->name('dc.index');
            Route::get('deliverycharge-edit/{id}', [DeliveryChargeController::class, 'edit'])->middleware('permission:delivery_charge_edit')->name('dc.edit');
            Route::post('deliverycharge-update', [DeliveryChargeController::class, 'update'])->middleware('permission:delivery_charge_edit')->name('dc.update');
            Route::get('deliverycharge-delete/{id}', [DeliveryChargeController::class, 'destroy'])->name('dc.delete');
        });
    });

    // All Payments
    Route::group(['prefix' => 'payments'], function () {
        // Merchant payments
        Route::get('/merchant-due-payment-show', [MerchantPaymentController::class, 'merchantDuePaymentShow'])->name('payment.merchant.due.show')->middleware('permission:payment_to_merchant');
        Route::get('/merchant-due-payment/{id}', [MerchantPaymentController::class, 'merchantDuePayment'])->name('payment.merchant.due')->middleware('permission:payment_to_merchant');
        Route::post('/merchant-due-sumbit', [MerchantPaymentController::class, 'submitPaymentDue'])->name('payment.merchant.submit.due')->middleware('permission:payment_to_merchant');
        Route::get('merchant-payment-invoice', [MerchantPaymentController::class, 'merchantPaymentInvoice'])->name('payment.merchant.invoice')->middleware('permission:payment_to_merchant');
        Route::get('merchant-payment-invoice-export/{id}', [MerchantPaymentController::class, 'merchantPaymentInvoiceExport'])->name('payment.merchant.invoice.export')->middleware('permission:payment_to_merchant');
        Route::get('merchant-payment-invoice-print/{id}', [MerchantPaymentController::class, 'merchantPaymentInvoicePrint'])->name('payment.merchant.invoice.print')->middleware('permission:payment_to_merchant');
        Route::get('merchant-payment-invoice-download/{id}', [MerchantPaymentController::class, 'merchantPaymentInvoiceDownload'])->name('payment.merchant.invoice.download')->middleware('permission:payment_to_merchant');

        // pickupman payments
        Route::get('/pickupman-payments', [PickupmanPaymentController::class, 'index'])->name('payment.pickupman.index')->middleware('permission:payment_to_pickupman');
        Route::get('/pickupman-payments/{type}/{pickupmanId}', [PickupmanPaymentController::class, 'pickupmanPayments'])->name('pickupman_payments')->middleware('permission:payment_to_pickupman');
        Route::post('/pickupman-payment-success', [PickupmanPaymentController::class, 'pickupmanPayment'])->name('payment.pickupman.done')->middleware('permission:payment_to_pickupman');
        Route::get('pickupman-payment-invoice', [PickupmanPaymentController::class, 'PickupmanPaymentInvoice'])->name('payment.pickupman.invoice');
        Route::get('pickupman-payment-invoice-export/{id}', [PickupmanPaymentController::class, 'PickupmanPaymentInvoiceExport'])->name('payment.pickupman.invoice.export');
        Route::get('pickupman-payment-invoice-print/{id}', [PickupmanPaymentController::class, 'PickupmanPaymentInvoicePrint'])->name('payment.pickupman.invoice.print');
        Route::get('pickupman-payment-invoice-download/{id}', [PickupmanPaymentController::class, 'PickupmanPaymentInvoiceDownload'])->name('payment.pickupman.invoice.download');
        // Deliveryman payments
        Route::get('/deliveryman-payments', [DeliverymanPaymentController::class, 'index'])->name('payments.deliveryman.index')->middleware('permission:payment_to_deliveryman');
        Route::get('/deliveryman-payments/{type}/{deliverymanId}', [DeliverymanPaymentController::class, 'deliverymanPayments'])->name('deliveryman_payments')->middleware('permission:payment_to_deliveryman');
        Route::post('/deliveryman-payment', [DeliverymanPaymentController::class, 'deliverymanPayment'])->name('payment.deliveryman.done')->middleware('permission:payment_to_deliveryman');
        Route::get('/deliveryman-payment-invoice/{parcel_id}', [DeliverymanPaymentController::class, 'deliverymanPaymentInvoice'])->name('deliveryman_payment_invoice')->middleware('permission:payment_to_deliveryman');
        Route::get('deliveryman-payment-invoice', [DeliverymanPaymentController::class, 'deliverymanPaymentInvoice'])->name('payment.deliveryman.invoice');
        Route::get('deliveryman-payment-invoice-export/{id}', [DeliverymanPaymentController::class, 'deliverymanPaymentInvoiceExport'])->name('payment.deliveryman.invoice.export');
        Route::get('deliveryman-payment-invoice-print/{id}', [DeliverymanPaymentController::class, 'deliverymanPaymentInvoicePrint'])->name('payment.deliveryman.invoice.print');
        Route::get('deliveryman-payment-invoice-download/{id}', [DeliverymanPaymentController::class, 'deliverymanPaymentInvoiceDownload'])->name('payment.deliveryman.invoice.download');
        // agent payments
        Route::get('/agent-payments', [AgentPaymentController::class, 'index'])->name('payment.agent.index')->middleware('permission:payment_to_deliveryman');
        Route::get('/agent-payments/{type}/{agentId}', [AgentPaymentController::class, 'agentPayments'])->name('agent_payments')->middleware('permission:payment_to_deliveryman');
        Route::post('/agent-payment', [AgentPaymentController::class, 'agentPayment'])->name('payment.agent.done')->middleware('permission:payment_to_deliveryman');
        Route::get('/agent-payment-invoice/{parcel_id}', [AgentPaymentController::class, 'agentPaymentInvoice'])->name('agent_payment_invoice')->middleware('permission:payment_to_deliveryman');
        Route::get('agent-payment-invoice', [AgentPaymentController::class, 'agentPaymentInvoice'])->name('payment.agent.invoice');
        Route::get('agent-payment-invoice-export/{id}', [AgentPaymentController::class, 'agentPaymentInvoiceExport'])->name('payment.agent.invoice.export');
        Route::get('agent-payment-invoice-print/{id}', [AgentPaymentController::class, 'agentPaymentInvoicePrint'])->name('payment.agent.invoice.print');
        Route::get('agent-payment-invoice-download/{id}', [AgentPaymentController::class, 'agentPaymentInvoiceDownload'])->name('payment.agent.invoice.download');
    });

    // Merchant Management
    Route::group(['prefix' => 'merchant'], function () {
        Route::get('/merchant-create', [MerchantManageController::class, 'create'])->name('merchant.create');
        Route::post('/merchant-store', [MerchantManageController::class, 'store'])->name('merchant.store');
        Route::get('/merchant-manage', [MerchantManageController::class, 'index'])->name('merchant.manage');
        Route::get('/merchant-edit/{id}', [MerchantManageController::class, 'edit'])->name('merchant.edit');
        Route::post('/merchant-update', [MerchantManageController::class, 'update'])->name('merchant.update');
    });

    // Deliveryman Management
    Route::group(['prefix' => 'deliveryman'], function () {
        Route::get('/deliveryman-create', [DeliverymanManageController::class, 'create'])->name('deliveryman.create');
        Route::post('/deliveryman-store', [DeliverymanManageController::class, 'store'])->name('deliveryman.store');
        Route::get('/deliveryman-show/{id}', [DeliverymanManageController::class, 'show'])->name('deliveryman.show');
        Route::get('/deliveryman-manage', [DeliverymanManageController::class, 'index'])->name('deliveryman.manage');
        Route::get('/deliveryman-edit/{id}', [DeliverymanManageController::class, 'edit'])->name('deliveryman.edit');
        Route::post('/deliveryman-update', [DeliverymanManageController::class, 'update'])->name('deliveryman.update');
        Route::get('/deliveryman-delete/{id}', [DeliverymanManageController::class, 'destroy'])->name('deliveryman.delete');
    });

    // Pickupman Management
    Route::group(['prefix' => 'pickupman'], function () {
        Route::get('/pickupman-create', [PickupmanManageController::class, 'create'])->name('pickupman.create');
        Route::post('/pickupman-store', [PickupmanManageController::class, 'store'])->name('pickupman.store');
        Route::get('/pickupman-show/{id}', [PickupmanManageController::class, 'show'])->name('pickupman.show');
        Route::get('/pickupman-manage', [PickupmanManageController::class, 'index'])->name('pickupman.manage');
        Route::get('/pickupman-edit/{id}', [PickupmanManageController::class, 'edit'])->name('pickupman.edit');
        Route::post('/pickupman-update', [PickupmanManageController::class, 'update'])->name('pickupman.update');
        Route::get('/pickupman-delete/{id}', [PickupmanManageController::class, 'destroy'])->name('pickupman.delete');
    });

    // Employee Management
    Route::group(['prefix' => 'employee'], function () {
        Route::get('/employee-create', [EmployeeManageController::class, 'create'])->name('employee.create');
        Route::post('/employee-store', [EmployeeManageController::class, 'store'])->name('employee.store');
        Route::get('/employee-show/{id}', [EmployeeManageController::class, 'show'])->name('employee.show');
        Route::get('/employee-manage', [EmployeeManageController::class, 'index'])->name('employee.manage');
        Route::get('/employee-edit/{id}', [EmployeeManageController::class, 'edit'])->name('employee.edit');
        Route::post('/employee-update', [EmployeeManageController::class, 'update'])->name('employee.update');
        Route::get('/employee-delete/{id}', [EmployeeManageController::class, 'destroy'])->name('employee.delete');
    });

    // Employee Management
    Route::group(['prefix' => 'agent'], function () {
        Route::get('/agent', [AgentManageController::class, 'index'])->name('agent');
        Route::get('/agent-create', [AgentManageController::class, 'create'])->name('agent.create');
        Route::post('/agent-store', [AgentManageController::class, 'store'])->name('agent.store');
        Route::get('/agent-show/{id}', [AgentManageController::class, 'show'])->name('agent.show');
        Route::get('/agent-manage', [AgentManageController::class, 'index'])->name('agent.manage');
        Route::get('/agent-edit/{id}', [AgentManageController::class, 'edit'])->name('agent.edit');
        Route::post('/agent-update', [AgentManageController::class, 'update'])->name('agent.update');
        Route::get('/agent-delete/{id}', [AgentManageController::class, 'destroy'])->name('agent.delete');
    });

    // Report Management
    Route::group(['prefix' => 'report'], function () {
        Route::get('/summary', [ReportManageController::class, 'reportSummary'])->name('report.summary')->middleware('permission:summary_report');
        Route::get('/merchant', [ReportManageController::class, 'merchantReport'])->name('report.merchant');
        Route::get('/deliveryman', [ReportManageController::class, 'deliverymanReport'])->name('report.deliveryman');
        Route::get('/deliveryman/details', [ReportManageController::class, 'deliverymanReportDetails'])->name('report.deliveryman.details');
        Route::get('/pickupman', [ReportManageController::class, 'pickupmanReport'])->name('report.pickupman');
        Route::get('/agent', [ReportManageController::class, 'agentReport'])->name('report.agent');
    });

    // Areas Management
    Route::group(['prefix' => 'areas'], function () {
        // division
        Route::get('division', [DivisionController::class, 'index'])->name('division.index')->middleware('permission:division');
        Route::get('division-create', [DivisionController::class, 'create'])->name('division.create')->middleware('permission:division_add');
        Route::post('division-store', [DivisionController::class, 'store'])->name('division.store')->middleware('permission:division_add');
        Route::get('division-edit/{id}', [DivisionController::class, 'edit'])->name('division.edit')->middleware('permission:division_edit');
        Route::post('division-update', [DivisionController::class, 'update'])->name('division.update')->middleware('permission:division_edit');
        Route::get('division-delete/{id}', [DivisionController::class, 'destroy'])->name('division.delete')->middleware('permission:division_delete');

        // district
        Route::get('district', [DistrictController::class, 'index'])->name('district.index')->middleware('permission:district');
        Route::get('district-create', [DistrictController::class, 'create'])->name('district.create')->middleware('permission:district_add');
        Route::post('district-store', [DistrictController::class, 'store'])->name('district.store')->middleware('permission:district_add');
        Route::get('district-edit/{id}', [DistrictController::class, 'edit'])->name('district.edit')->middleware('permission:district_edit');
        Route::post('district-update', [DistrictController::class, 'update'])->name('district.update')->middleware('permission:edit');
        Route::get('district-delete/{id}', [DistrictController::class, 'destroy'])->name('district.delete')->middleware('permission:delete');

        // thana
        Route::get('thana', [ThanaController::class, 'index'])->name('thana.index')->middleware('permission:thana');
        Route::get('thana-create', [ThanaController::class, 'create'])->name('thana.create')->middleware('permission:thana_add');
        Route::post('thana-store', [ThanaController::class, 'store'])->name('thana.store')->middleware('permission:thana_add');
        Route::get('thana-edit/{id}', [ThanaController::class, 'edit'])->name('thana.edit')->middleware('permission:thana_edit');
        Route::post('thana-update', [ThanaController::class, 'update'])->name('thana.update')->middleware('permission:thana_edit');
        Route::get('thana-delete/{id}', [ThanaController::class, 'destroy'])->name('thana.delete')->middleware('permission:thana_delete');

        // area
        Route::get('area', [AreaController::class, 'index'])->name('area.index')->middleware('permission:area');
        Route::get('area-create', [AreaController::class, 'create'])->name('area.create')->middleware('permission:area_add');
        Route::post('area-store', [AreaController::class, 'store'])->name('area.store')->middleware('permission:area_add');
        Route::get('area-edit/{id}', [AreaController::class, 'edit'])->name('area.edit')->middleware('permission:area_edit');
        Route::post('area-update', [AreaController::class, 'update'])->name('area.update')->middleware('permission:area_edit');
        Route::get('area-delete/{id}', [AreaController::class, 'destroy'])->name('area.delete')->middleware('permission:area_delete');

        //import areas
        Route::get('import-areas', [AreaManageController::class, 'importAreas'])->name('area.import');
        Route::post('import-areas-store', [AreaManageController::class, 'importAreasStore'])->name('area.import.store');
    });

    // Attendence Management
    Route::group(['prefix' => 'attendence'], function () {
        Route::get('/manage-attendence', [AttendenceManageController::class, 'index'])->name('attendence.index');
        Route::get('/take-attendence', [AttendenceManageController::class, 'create'])->name('attendence.create');
        Route::post('/take-attendence-store', [AttendenceManageController::class, 'store'])->name('attendence.store');
        Route::post('/take-attendence-update', [AttendenceManageController::class, 'update'])->name('attendence.update');
        // Route::post('/take-attendence-update', [AttendenceManageController::class, 'update'])->name('attendence.update');
    });

    // Employee Salary
    Route::group(['prefix' => 'employee-salary'], function () {
        Route::get('employee-salary-sheet', [EmployeeSalaryController::class, 'index'])->name('employee.salary.sheet');
        Route::get('employee-create-salary', [EmployeeSalaryController::class, 'create'])->name('employee.salary.create');
        Route::post('employee-create-salary-sheet', [EmployeeSalaryController::class, 'store'])->name('employee.salary.store');
        Route::get('employee-salary-details/{id}/{selection}', [EmployeeSalaryController::class, 'show'])->name('employee.salary.sheet.details');
        Route::post('employee-salary-paid', [EmployeeSalaryController::class, 'paid'])->name('employee.salary.sheet.paid');

        // Employee Advance Salary
        Route::get('employee-advance-salary', [EmployeeAdvanceSalaryController::class, 'index'])->name('employee.advance.salary.index');
        Route::get('employee-advance-salary-create', [EmployeeAdvanceSalaryController::class, 'create'])->name('employee.advance.salary.create');
        Route::post('employee-advance-salary-store', [EmployeeAdvanceSalaryController::class, 'store'])->name('employee.advance.salary.store');
        Route::get('employee-advance-salary-edit/{id}', [EmployeeAdvanceSalaryController::class, 'edit'])->name('employee.advance.salary.edit');
    });

    // deliveryman salary
    Route::group(['prefix' => 'deliveryman-salary'], function () {
        Route::get('deliveryman-salary-sheet', [EmployeeSalaryController::class, 'index'])->name('deliveryman.salary.sheet');
        Route::get('deliveryman-create-salary', [EmployeeSalaryController::class, 'create'])->name('deliveryman.salary.create');
        Route::post('deliveryman-create-salary-sheet', [EmployeeSalaryController::class, 'store'])->name('deliveryman.salary.store');
        Route::get('deliveryman-salary-details/{id}', [EmployeeSalaryController::class, 'show'])->name('deliveryman.salary.sheet.details');
        Route::post('deliveryman-salary-paid', [EmployeeSalaryController::class, 'paid'])->name('deliveryman.salary.sheet.paid');

        // Employee Advance Salary
        Route::get('deliveryman-advance-salary', [EmployeeAdvanceSalaryController::class, 'index'])->name('deliveryman.advance.salary.index');
        Route::get('deliveryman-advance-salary-create', [EmployeeAdvanceSalaryController::class, 'create'])->name('deliveryman.advance.salary.create');
        Route::post('deliveryman-advance-salary-store', [EmployeeAdvanceSalaryController::class, 'store'])->name('deliveryman.advance.salary.store');
        Route::get('deliveryman-advance-salary-edit/{id}', [EmployeeAdvanceSalaryController::class, 'edit'])->name('deliveryman.advance.salary.edit');
    });

    // deliveryman salary
    Route::group(['prefix' => 'pickupman-salary'], function () {
        Route::get('pickupman-salary-sheet', [EmployeeSalaryController::class, 'index'])->name('pickupman.salary.sheet');
        Route::get('pickupman-create-salary', [EmployeeSalaryController::class, 'create'])->name('pickupman.salary.create');
        Route::post('pickupman-create-salary-sheet', [EmployeeSalaryController::class, 'store'])->name('pickupman.salary.store');
        Route::get('pickupman-salary-details/{id}', [EmployeeSalaryController::class, 'show'])->name('pickupman.salary.sheet.details');
        Route::post('pickupman-salary-paid', [EmployeeSalaryController::class, 'paid'])->name('pickupman.salary.sheet.paid');

        // Employee Advance Salary
        Route::get('pickupman-advance-salary', [EmployeeAdvanceSalaryController::class, 'index'])->name('pickupman.advance.salary.index');
        Route::get('pickupman-advance-salary-create', [EmployeeAdvanceSalaryController::class, 'create'])->name('pickupman.advance.salary.create');
        Route::post('pickupman-advance-salary-store', [EmployeeAdvanceSalaryController::class, 'store'])->name('pickupman.advance.salary.store');
        Route::get('pickupman-advance-salary-edit/{id}', [EmployeeAdvanceSalaryController::class, 'edit'])->name('pickupman.advance.salary.edit');
    });

    // Users Management
    Route::group(['prefix' => 'users'], function () {
        Route::get('/users', [UserManageController::class, 'index'])->name('users.manage');
        Route::get('/users-create', [UserManageController::class, 'create'])->name('users.create');
        Route::post('/users-store', [UserManageController::class, 'store'])->name('users.store');
        Route::get('/users-edit/{id}', [UserManageController::class, 'edit'])->name('users.edit');
        Route::post('/users-update', [UserManageController::class, 'update'])->name('users.update');
    });

    // Short message service
    Route::group(['prefix' => 'sms'], function () {
        Route::get('/sms', [SmsManageController::class, 'index'])->name('sms.manage');
        Route::post('/sms-store', [SmsManageController::class, 'store'])->name('sms.store');
        Route::get('/sms-resend/{id}', [SmsManageController::class, 'update'])->name('sms.resend');
        Route::get('/sms-delete/{id}', [SmsManageController::class, 'destroy'])->name('sms.delete');
    });

    // accounts
    Route::group(['prefix' => 'accounts'], function () {
        // income cateogry
        Route::group(['prefix' => 'income'], function () {
            Route::get('income-head', [IncomeCategoryController::class, 'index'])->name('income.head.index');
            Route::get('income-head-create', [IncomeCategoryController::class, 'create'])->name('income.head.create');
            Route::post('income-head-store', [IncomeCategoryController::class, 'store'])->name('income.head.store');
            Route::get('income-head-edit/{id}', [IncomeCategoryController::class, 'edit'])->name('income.head.edit');
            Route::post('income-head-update', [IncomeCategoryController::class, 'update'])->name('income.head.update');
            Route::get('income-head-delete/{id}', [IncomeCategoryController::class, 'destroy'])->name('income.head.delete');
        });

        // income
        Route::group(['prefix' => 'income'], function () {
            Route::get('income', [IncomeManageController::class, 'index'])->name('income.index');
            Route::get('income-show/{id}', [IncomeManageController::class, 'show'])->name('income.show');
            Route::get('income-create', [IncomeManageController::class, 'create'])->name('income.create');
            Route::post('income-store', [IncomeManageController::class, 'store'])->name('income.store');
            Route::get('income-edit/{id}', [IncomeManageController::class, 'edit'])->name('income.edit');
            Route::post('income-update', [IncomeManageController::class, 'update'])->name('income.update');
            Route::get('income-delete/{id}', [IncomeManageController::class, 'destroy'])->name('income.delete');
        });

        // expense cateogry
        Route::group(['prefix' => 'expense'], function () {
            Route::get('expense-head', [ExpenseCategoryController::class, 'index'])->name('expense.head.index');
            Route::get('expense-head-create', [ExpenseCategoryController::class, 'create'])->name('expense.head.create');
            Route::post('expense-head-store', [ExpenseCategoryController::class, 'store'])->name('expense.head.store');
            Route::get('expense-head-edit/{id}', [ExpenseCategoryController::class, 'edit'])->name('expense.head.edit');
            Route::post('expense-head-update', [ExpenseCategoryController::class, 'update'])->name('expense.head.update');
            Route::get('expense-head-delete/{id}', [ExpenseCategoryController::class, 'destroy'])->name('expense.head.delete');
        });

        // expense
        Route::group(['prefix' => 'expense'], function () {
            Route::get('expense', [ExpenseManageController::class, 'index'])->name('expense.index');
            Route::get('expense-show/{id}', [ExpenseManageController::class, 'show'])->name('expense.show');
            Route::get('expense-create', [ExpenseManageController::class, 'create'])->name('expense.create');
            Route::post('expense-store', [ExpenseManageController::class, 'store'])->name('expense.store');
            Route::get('expense-edit/{id}', [ExpenseManageController::class, 'edit'])->name('expense.edit');
            Route::post('expense-update', [ExpenseManageController::class, 'update'])->name('expense.update');
            Route::get('expense-delete/{id}', [ExpenseManageController::class, 'destroy'])->name('expense.delete');
        });

        // Deliveryman expense
        Route::group(['prefix' => 'deliveryman-expense'], function () {
            Route::get('expense', [DeliverymanExpenseController::class, 'index'])->name('dman.expense.index');
            Route::get('expense-show/{id}', [DeliverymanExpenseController::class, 'show'])->name('dman.expense.show');
            Route::get('expense-create', [DeliverymanExpenseController::class, 'create'])->name('dman.expense.create');
            Route::post('expense-store', [DeliverymanExpenseController::class, 'store'])->name('dman.expense.store');
            Route::get('expense-edit/{id}', [DeliverymanExpenseController::class, 'edit'])->name('dman.expense.edit');
            Route::post('expense-update', [DeliverymanExpenseController::class, 'update'])->name('dman.expense.update');
            Route::get('expense-delete/{id}', [DeliverymanExpenseController::class, 'destroy'])->name('dman.expense.delete');
            Route::get('print', [DeliverymanExpenseController::class, 'print'])->name('dman.expense.print');
        });

        // Pickupman expense
        Route::group(['prefix' => 'pickupman-expense'], function () {
            Route::get('expense', [PickupmanExpenseController::class, 'index'])->name('pman.expense.index');
            Route::get('expense-show/{id}', [PickupmanExpenseController::class, 'show'])->name('pman.expense.show');
            Route::get('expense-create', [PickupmanExpenseController::class, 'create'])->name('pman.expense.create');
            Route::post('expense-store', [PickupmanExpenseController::class, 'store'])->name('pman.expense.store');
            Route::get('expense-edit/{id}', [PickupmanExpenseController::class, 'edit'])->name('pman.expense.edit');
            Route::post('expense-update', [PickupmanExpenseController::class, 'update'])->name('pman.expense.update');
            Route::get('expense-delete/{id}', [PickupmanExpenseController::class, 'destroy'])->name('pman.expense.delete');
            Route::get('print', [PickupmanExpenseController::class, 'print'])->name('pman.expense.print');
        });

        // trial balance
        Route::get('trial-balance', [AccountController::class, 'trialBalance'])->name('accounts.trial.balance');
        // cashbook
        Route::get('cash-book', [AccountController::class, 'cashBook'])->name('accounts.cash.book');
        // ledger
        Route::get('ledger', [AccountController::class, 'ledger'])->name('accounts.ledger');
    });

    // Settings
    Route::group(['prefix' => 'settings'], function () {
        Route::get('settings', [SiteSettings::class, 'siteSettings'])->name('site.settings');
        Route::post('settings-update', [SiteSettings::class, 'siteSettingsUpdate'])->name('site.settings.update');

        Route::group(['prefix' => 'sliders'], function () {
            Route::get('slider', [SliderController::class, 'index'])->name('slider.index');
            Route::get('slider-create', [SliderController::class, 'create'])->name('slider.create');
            Route::post('slider-store', [SliderController::class, 'store'])->name('slider.store');
            Route::get('slider-edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
            Route::post('slider-update', [SliderController::class, 'update'])->name('slider.update');
            Route::get('slider-delete/{id}', [SliderController::class, 'destroy'])->name('slider.delete');
        });

        Route::group(['prefix' => 'features'], function () {
            Route::get('feature', [FeatureController::class, 'index'])->name('feature.index');
            Route::get('feature-create', [FeatureController::class, 'create'])->name('feature.create');
            Route::post('feature-store', [FeatureController::class, 'store'])->name('feature.store');
            Route::get('feature-edit/{id}', [FeatureController::class, 'edit'])->name('feature.edit');
            Route::post('feature-update', [FeatureController::class, 'update'])->name('feature.update');
            Route::get('feature-delete/{id}', [FeatureController::class, 'destroy'])->name('feature.delete');
        });

        Route::group(['prefix' => 'hub'], function () {
            Route::get('hub', [HubAreaController::class, 'index'])->name('hub.index');
            Route::get('hub-create', [HubAreaController::class, 'create'])->name('hub.create');
            Route::post('hub-store', [HubAreaController::class, 'store'])->name('hub.store');
            Route::get('hub-edit/{id}', [HubAreaController::class, 'edit'])->name('hub.edit');
            Route::post('hub-update', [HubAreaController::class, 'update'])->name('hub.update');
            Route::get('hub-delete/{id}', [HubAreaController::class, 'destroy'])->name('hub.delete');
        });

        Route::group(['prefix' => 'services'], function () {
            Route::get('services', [ServicesController::class, 'index'])->name('service.index');
            Route::get('service-create', [ServicesController::class, 'create'])->name('service.create');
            Route::post('service-store', [ServicesController::class, 'store'])->name('service.store');
            Route::get('service-edit/{id}', [ServicesController::class, 'edit'])->name('service.edit');
            Route::post('service-update', [ServicesController::class, 'update'])->name('service.update');
            Route::get('service-delete/{id}', [ServicesController::class, 'destroy'])->name('service.delete');
        });
    });


    // barcode reader
    Route::get('scanner', [SuperadminController::class, 'barcodeScanner'])->name('scanner');
});


// get customer details
Route::get('get-customer-details', [SuperadminController::class, 'getCustomerDetails'])->name('get_customer_details');
Route::get('set-customer-details', [SuperadminController::class, 'setCustomerDetails'])->name('set_customer_details');
