<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthenticationController;
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


// ====== Public Routes ======

// Login Routes
Route::get('/', [AuthenticationController::class , 'index'])->middleware("isLoggedIn");
Route::post("/login" , [AuthenticationController::class, "login"])->name("login")->middleware("isLoggedIn");


// ====== Private Routes ======

Route::middleware(["loggedIn"])->group(function() {

    // ====== Dashboard Routes ======
    Route::get('/dashboard', [DashboardController::class  , 'index']);


    // ====== Users Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/users', [UserController::class, "index"]);
    Route::get('/dashboard/users/add', [UserController::class, "createPage"]);
    Route::get('/dashboard/users/edit/{id}', [UserController::class, "editPage"]);
    Route::get('/dashboard/users/{id}', [UserController::class, "singlePage"]);
    //-- Data Management Routes
    Route::post("/dashboard/users/add", [UserController::class, "store"])->name("add_user");
    Route::put("/dashboard/users/edit", [UserController::class, "update"])->name("edit_user");
    Route::delete("/dashboard/users/delete", [UserController::class, "destroy"])->name("delete_user");

    // ====== Flat Routes ======
    // ==========================
    




    Route::get("/logout" , [AuthenticationController::class, "logout"]);

});
