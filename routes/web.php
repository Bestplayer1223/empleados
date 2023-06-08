<?php

use App\Models\Empleado;
use App\Models\EmpleadoRol;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $data = Empleado::with(['foreignArea'])
    ->orderBy('id', 'asc')->get();

    foreach ($data as $worker) {
        $worker['roles'] = EmpleadoRol::where('empleado_id',$worker->id)->get();
    }

    return view('home',compact('data'));
});
