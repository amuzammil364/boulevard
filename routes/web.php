<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ResidentsController;
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
    //-- Page View Routes
    Route::get('/dashboard/flats', [FlatController::class, "index"]);
    Route::get('/dashboard/flats/add', [FlatController::class, "createPage"]);
    Route::get('/dashboard/flats/edit/{id}', [FlatController::class, "editPage"]);
    Route::get('/dashboard/flats/{id}', [FlatController::class, "singlePage"]);
    //-- Data Management Routes
    Route::post("/dashboard/flats/add", [FlatController::class, "store"])->name("add_flat");
    Route::delete("/dashboard/flats/delete", [FlatController::class, "destroy"])->name("delete_flat");
    Route::put("/dashboard/flats/edit", [FlatController::class, "update"])->name("edit_flat");

    // ====== Residents Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/residents', [ResidentsController::class, "index"]);
    Route::get('/dashboard/residents/add', [ResidentsController::class, "createPage"]);
    Route::get('/dashboard/residents/edit/{id}', [ResidentsController::class, "editPage"]);
    Route::get('/dashboard/residents/{id}', [ResidentsController::class, "singlePage"]);
    //-- Data Management Routes
    Route::post("/dashboard/residents/add", [ResidentsController::class, "store"])->name("add_resident");
    Route::delete("/dashboard/residents/delete", [ResidentsController::class, "destroy"])->name("delete_resident");
    Route::put("/dashboard/residents/edit", [ResidentsController::class, "update"])->name("edit_resident");

    // ====== Payments Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/payments', [PaymentsController::class, "index"]);
    Route::get('/dashboard/payments/add', [PaymentsController::class, "createPage"]);
    Route::get('/dashboard/payments/edit/{id}', [PaymentsController::class, "editPage"]);
    Route::get('/dashboard/payments/{id}', [PaymentsController::class, "singlePage"]);
    //-- Data Management Routes
    Route::post("/dashboard/payments/add", [PaymentsController::class, "store"])->name("add_payment");
    Route::delete("/dashboard/payments/delete", [PaymentsController::class, "destroy"])->name("delete_payment");
    Route::put("/dashboard/payments/edit", [PaymentsController::class, "update"])->name("edit_payment");

    // ====== Employees Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/employees', [EmployeesController::class, "index"]);
    Route::get('/dashboard/employees/add', [EmployeesController::class, "createPage"]);
    Route::get('/dashboard/employees/edit/{id}', [EmployeesController::class, "editPage"]);
    Route::get('/dashboard/employees/{id}', [EmployeesController::class, "singlePage"]);
    //-- Data Management Routes
    Route::post("/dashboard/employees/add", [EmployeesController::class, "store"])->name("add_employee");
    Route::delete("/dashboard/employees/delete", [EmployeesController::class, "destroy"])->name("delete_employee");
    Route::put("/dashboard/employees/edit", [EmployeesController::class, "update"])->name("edit_employee");




    Route::get("/logout" , [AuthenticationController::class, "logout"]);

});
