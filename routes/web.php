<?php

use App\Http\Controllers\UserController;
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
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard/dashboard');
});

Route::get('/dashboard/users', [UserController::class, "index"]);
Route::post("/dashboard/users/add", [UserController::class, "store"])->name("add_user");
Route::delete("/dashboard/users/delete", [UserController::class, "destroy"])->name("delete_user");
