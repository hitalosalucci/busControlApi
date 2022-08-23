<?php

use App\Http\Controllers\BusChairController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OriginController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\TravelSaleController;
use App\Models\BusChair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/ping', function(){
    return [
        'ping' => true
    ];
});


Route::group(['prefix' => 'travel_sales', 'as' => 'travel_sales.'], function () {
    
    Route::get('/list', [TravelSaleController::class, 'getAllTravelSales'])->name('getAllTravelSales');
    Route::get('/list/{uuid}', [TravelSaleController::class, 'getTravelSalePerUuid'])->name('getTravelSalePerUuid');
    Route::get('/list_per_bus/{uuid}', [TravelSaleController::class, 'getTravelSalesPerBusUuid'])->name('getTravelSalesPerBusUuid');
    Route::post('/add', [TravelSaleController::class, 'addTravelSale'])->name('addTravelSale');
    Route::delete('/delete', [TravelSaleController::class, 'deleteTravelSale'])->name('deleteTravelSale');

});

Route::group(['prefix' => 'buses', 'as' => 'buses.'], function () {
    Route::get('/list', [BusController::class, 'getAllBuses'])->name('getAllBuses');
});

Route::group(['prefix' => 'bus_chairs', 'as' => 'bus_chairs.'], function () {
    Route::get('/list_per_bus/{uuid}', [BusChairController::class, 'getAllChairsPerBusUuid'])->name('getAllChairsPerBusUuid');
});

Route::group(['prefix' => 'origins', 'as' => 'origins.'], function () {
    Route::get('/list', [OriginController::class, 'getAllOrigins'])->name('getAllOrigins');
});

Route::group(['prefix' => 'destinations', 'as' => 'destinations.'], function () {
    Route::get('/list', [DestinationController::class, 'getAllDestinations'])->name('getAllDestinations');
});

Route::group(['prefix' => 'drivers', 'as' => 'drivers.'], function () {
    Route::get('/list', [DriverController::class, 'getAllDrivers'])->name('getAllDrivers');
});

Route::group(['prefix' => 'travels', 'as' => 'travels.'], function () {
    Route::get('/list', [TravelController::class, 'getAllTravels'])->name('getAllTravels');
});

Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
    Route::get('/list', [CustomerController::class, 'getAllCustomers'])->name('getAllCustomers');
});

//travel sale get
//travel sale post
//travel sale put
//travel sale delete