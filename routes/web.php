<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ResidentsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\DefaultersController;
use App\Http\Controllers\PrintReceiptController;
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
Route::get('/', [AuthenticationController::class, 'index'])->middleware("isLoggedIn");
Route::post("/login", [AuthenticationController::class, "login"])->name("login")->middleware("isLoggedIn");
Route::get('/dashboard/view-receipt', [PrintReceiptController::class, "index2"]);


// ====== Private Routes ======

Route::middleware(["loggedIn"])->group(function () {

    // ====== Dashboard Routes ======

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(["role:1,2"]);


    // ====== Users Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/users', [UserController::class, "index"])->middleware(["role:1"]);
    Route::get('/dashboard/users/add', [UserController::class, "createPage"])->middleware(["role:1"]);
    Route::get('/dashboard/users/edit/{id}', [UserController::class, "editPage"])->middleware(["role:1"]);
    Route::get('/dashboard/users/{id}', [UserController::class, "singlePage"])->middleware(["role:1"]);
    //-- Data Management Routes
    Route::post("/dashboard/users/add", [UserController::class, "store"])->name("add_user")->middleware(["role:1"]);
    Route::put("/dashboard/users/edit", [UserController::class, "update"])->name("edit_user")->middleware(["role:1"]);
    Route::delete("/dashboard/users/delete", [UserController::class, "destroy"])->name("delete_user")->middleware(["role:1"]);

    // ====== Flat Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/flats', [FlatController::class, "index"])->middleware(["role:1"]);
    Route::get('/dashboard/flats/add', [FlatController::class, "createPage"])->middleware(["role:1"]);
    Route::get('/dashboard/flats/edit/{id}', [FlatController::class, "editPage"])->middleware(["role:1"]);
    Route::get('/dashboard/flats/{id}', [FlatController::class, "singlePage"])->middleware(["role:1"]);
    //-- Data Management Routes
    Route::post("/dashboard/flats/add", [FlatController::class, "store"])->name("add_flat")->middleware(["role:1"]);
    Route::delete("/dashboard/flats/delete", [FlatController::class, "destroy"])->name("delete_flat")->middleware(["role:1"]);
    Route::put("/dashboard/flats/edit", [FlatController::class, "update"])->name("edit_flat")->middleware(["role:1"]);

    // ====== Residents Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/residents', [ResidentsController::class, "index"])->name('residents')->middleware(["role:1,2"]);
    Route::get('/dashboard/residents/add', [ResidentsController::class, "createPage"])->middleware(["role:1,2"]);
    Route::get('/dashboard/residents/edit/{id}', [ResidentsController::class, "editPage"])->middleware(["role:1,2"]);
    Route::get('/dashboard/residents/{id}', [ResidentsController::class, "singlePage"])->middleware(["role:1,2"]);
    //-- Data Management Routes
    Route::post("/dashboard/residents/add", [ResidentsController::class, "store"])->name("add_resident")->middleware(["role:1,2"]);
    Route::delete("/dashboard/residents/delete", [ResidentsController::class, "destroy"])->name("delete_resident")->middleware(["role:1,2"]);
    Route::put("/dashboard/residents/edit", [ResidentsController::class, "update"])->name("edit_resident")->middleware(["role:1,2"]);

    // ====== Payments Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/payments', [PaymentsController::class, "index"])->name("payments")->middleware(["role:1"]);
    Route::get('/dashboard/payments/add', [PaymentsController::class, "createPage"])->middleware(["role:1"]);
    Route::get('/dashboard/payments/edit/{id}', [PaymentsController::class, "editPage"])->middleware(["role:1"]);
    Route::get('/dashboard/payments/{id}', [PaymentsController::class, "singlePage"])->middleware(["role:1"]);
    //-- Data Management Routes
    Route::post("/dashboard/payments/add", [PaymentsController::class, "store"])->name("add_payment")->middleware(["role:1"]);
    Route::post("/dashboard/payments/generate", [PaymentsController::class, "generate_payments"])->name("generate_payment")->middleware(["role:1"]);
    Route::delete("/dashboard/payments/delete", [PaymentsController::class, "destroy"])->name("delete_payment")->middleware(["role:1"]);
    Route::put("/dashboard/payments/edit", [PaymentsController::class, "update"])->name("edit_payment")->middleware(["role:1"]);


    // ====== Expenses Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/expenses', [ExpensesController::class, "index"])->name('expenses')->middleware(["role:1"]);
    Route::get('/dashboard/expenses/add', [ExpensesController::class, "createPage"])->middleware(["role:1"]);
    Route::get('/dashboard/expenses/edit/{id}', [ExpensesController::class, "editPage"])->middleware(["role:1"]);
    Route::get('/dashboard/expenses/{id}', [ExpensesController::class, "singlePage"])->middleware(["role:1"]);
    //-- Data Management Routes
    Route::post("/dashboard/expenses/add", [ExpensesController::class, "store"])->name("add_expense")->middleware(["role:1"]);
    Route::delete("/dashboard/expenses/delete", [ExpensesController::class, "destroy"])->name("delete_expense")->middleware(["role:1"]);
    Route::put("/dashboard/expenses/edit", [ExpensesController::class, "update"])->name("edit_expense")->middleware(["role:1"]);

    // ====== Employees Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/employees', [EmployeesController::class, "index"])->middleware(["role:1,2"]);
    Route::get('/dashboard/employees/add', [EmployeesController::class, "createPage"])->middleware(["role:1,2"]);
    Route::get('/dashboard/employees/edit/{id}', [EmployeesController::class, "editPage"])->middleware(["role:1,2"]);
    Route::get('/dashboard/employees/{id}', [EmployeesController::class, "singlePage"])->middleware(["role:1,2"]);
    //-- Data Management Routes
    Route::post("/dashboard/employees/add", [EmployeesController::class, "store"])->name("add_employee")->middleware(["role:1,2"]);
    Route::delete("/dashboard/employees/delete", [EmployeesController::class, "destroy"])->name("delete_employee")->middleware(["role:1,2"]);
    Route::put("/dashboard/employees/edit", [EmployeesController::class, "update"])->name("edit_employee")->middleware(["role:1,2"]);

    // ====== Transaction Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/transactions', [TransactionController::class, "index"])->middleware(["role:1"]);

    // ====== Summary Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/summary', [SummaryController::class, "index"])->middleware(["role:1"])->name("summary");

    // ====== Reports Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/reports', [ReportsController::class, "index"])->middleware(["role:1"]);

    // ====== Defaulters Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/defaulters', [DefaultersController::class, "index"])->middleware(["role:1"])->name("defaulters");

    // ====== Print Receipt Routes ======
    // ==========================
    //-- Page View Routes
    Route::get('/dashboard/print-receipt', [PrintReceiptController::class, "index"])->middleware(["role:1"]);


    Route::post('send-receipt-mail', [MailController::class, 'index'])->name('sendReceiptMail');
    Route::post('send-reminder-mail', [MailController::class, 'reminder_mail'])->name('sendReminderMail');


    // ====== Settings/options Routes ======
    //-- Page View Routes
    Route::get('/dashboard/settings', [OptionsController::class, "index"])->middleware(["role:1"]);
    //-- Data Management Routes
    Route::post("/dashboard/settings/add", [OptionsController::class, "store"])->name("add_options")->middleware(["role:1"]);

    Route::get("/dashboard/send-receipt" , [MailController::class, "index"]);

    Route::get("/logout", [AuthenticationController::class, "logout"]);
});
