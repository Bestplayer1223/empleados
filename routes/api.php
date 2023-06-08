<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

// ----------------------- API ROUTES ------------------------------//
/***
 **\ showWorkers => end-point that returns all info from the table

 **\ searchWorkersByFields => end-point that returns information by fields and filters from the table

 **\ createWorker => end-point that create and insert into the table associated

 **\ updateWorker => end-point that update into the table associated => to send info in the form-data with the method PUT, theres got to be an field called "_method" and its value must be "PUT"

 **\ deleteWorker => end-point that delete the a record
 *
 */

 Route::controller(EmpleadoController::class)->group(function () {
    Route::get('showWorkers', 'showAllWorkers');
    Route::get('searchWorkersByFields', 'searchWorkersByFields');
    Route::post('createWorker', 'createWorker');
    Route::put('updateWorker/{id}', 'updateWorker');
    Route::put('deleteWorker/{id}', 'deleteWorker');
});

Route::controller(ServicesController::class)->group(function () {
    Route::get('showAreas', 'showAllAreas');
    Route::get('showRoles', 'showAllRoles');
});
