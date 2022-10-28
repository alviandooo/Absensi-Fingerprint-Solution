<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;

use Rats\Zkteco\Lib\ZKTeco;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/users', function () {

    $zk = new ZKTeco('192.168.125.21');

    try {
        $zk->connect(); 
    } catch (\Throwable $th) {
        dd($th);
    }

    $users = $zk->getUser(); 

    return response()->json($users);
    // return $users;

});

Route::get('/att', function () {

    $zk = new ZKTeco('192.168.125.21');

    try {
        $zk->connect(); 
    } catch (\Throwable $th) {
        dd($th);
    }

    $att = $zk->getAttendance(); 

    $arr = [];

    foreach ($att as $key => $value) {
        $datetime = explode(" ", $value["timestamp"]);
        // dd($datetime[0]);

        if($datetime[0] >= "2022-10-20"){
            array_push($arr, $value);
        }
    }

    return response()->json($arr);
    // return $att;

});

Route::get('/tarik-absensi', [AbsensiController::class, 'tarikAbsensi']);
