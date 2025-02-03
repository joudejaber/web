<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DamageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\HomeownerMiddleware;
use App\Http\Middleware\ServiceProviderMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get("/login",[AuthController::class,"ShowLoginForm"])->name("login");
Route::post("/login",[AuthController::class,"login"])->name("login.form");
Route::get("/register",[AuthController::class,"ShowRegisterForm"])->name("register");
Route::post("/register",[AuthController::class,"register"])->name("register.form");
Route::get("/logout",[AuthController::class,"logout"])->name("logout");
Route::get('/services/page', [ServiceController::class, 'index'])->name('services.index');

Route::middleware(['auth'])->group( function () {
    Route::get("/dashboard",[DashboardController::class,"index"])->name("dashboard");
});

Route::middleware(['auth',HomeownerMiddleware::class])->group( function () {
    Route::get('/appointments/create', [AppointmentController::class,'createAppointment'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/damages/create',[DamageController::class,'create'])->name('damages.create');
    Route::post('/damages', [DamageController::class, 'store'])->name('damages.store');
    Route::get('/damages/{id}/edit', [DamageController::class, 'edit'])->name('damages.edit');
    Route::put('/damages/{id}', [DamageController::class, 'update'])->name('damages.update');
    Route::delete('/damages/{id}', [DamageController::class, 'destroy'])->name('damages.destroy');
    Route::get('/damages/{id}/add-images', [DamageController::class, 'addImages'])->name('damages.addimages');
    Route::post('/damages/{id}/store-images', [DamageController::class, 'storeImages'])->name('damages.storeimages');
    Route::delete('/damage-images/{id}', [DamageController::class, 'deleteImage'])->name('damages.images.destroy');
});

Route::middleware(['auth',ServiceProviderMiddleware::class])->group( function () {
    Route::get('/provider/appointments', [AppointmentController::class, 'providerAppointments'])->name('provider.appointments');
    Route::get('/appointments/{id}/accept', [AppointmentController::class, 'accept'])->name('appointment.accept');
    Route::get('/appointments/{id}/decline', [AppointmentController::class, 'decline'])->name('appointment.decline');
    Route::get('/services/create',[ServiceController::class,'create'])->name('services.create');
    Route::post('/services/store',[ServiceController::class,'store'])->name('services.store');
    Route::get('/service/edit/{id}',[ServiceController::class,'edit'])->name('services.edit');
    Route::post('/service/update/{id}',[ServiceController::class,'update'])->name('services.update');
    Route::get('/service/delete/{id}',[ServiceController::class,'destroy'])->name('services.delete');
    Route::get('/service/products/create',[ProductController::class,'create'])->name('products.create');
    Route::post('/service/products/store',[ProductController::class,'store'])->name('products.store');
    Route::get('/service/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/service/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/service/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.delete');
});