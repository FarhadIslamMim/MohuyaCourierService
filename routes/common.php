<?php

use App\Http\Controllers\Helpers\CommonController;
use Illuminate\Support\Facades\Route;

// ajax get areas
Route::get('/get-division-districts', [CommonController::class, 'getDivisionDistricts'])->name('get_division_districts');
Route::get('/get-district-thanas', [CommonController::class, 'getDistrictThanas'])->name('get_district_thanas');
Route::get('/get-district-agents', [CommonController::class, 'getDistrictAgents'])->name('get_district_agents');
Route::get('/get-thana-deliverymen-pickupman', [CommonController::class, 'getThanaDeliverymenPickupman'])->name('get_thana_deliverymen_pickupman');
Route::get('/get-thana-areas-final', [CommonController::class, 'getThanaAreasFinal'])->name('get_thana_areas_final');
Route::get('/get-thana-areas', [CommonController::class, 'getThanaAreas'])->name('get_thana_areas');
Route::get('/get-agent-areas', [CommonController::class, 'getAgentAreas'])->name('get_agent_areas');
Route::get('/get-area-address', [CommonController::class, 'getAreaAddress'])->name('get_area_address');
Route::get('/get-thana-agents', [CommonController::class, 'getThanaAgents'])->name('get_thana_agents');
Route::get('/get-agent-thanas', [CommonController::class, 'getAgentThanas'])->name('get_agents_thanas');
Route::get('/get-merchant-details', [CommonController::class, 'getMerchantDetails'])->name('get_merchant_details');
Route::get('/cost-calculator', [CommonController::class, 'costCalculate'])->name('cost.calculator');
