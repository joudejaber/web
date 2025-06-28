<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DamageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PersonalReportController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GovernmentMiddleware;
use App\Http\Middleware\HomeownerMiddleware;
use App\Http\Middleware\ServiceProviderMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GovernmentController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get("/login",[AuthController::class,"ShowLoginForm"])->name("login");
Route::post("/login",[AuthController::class,"login"])->name("login.form");
Route::get("/register",[AuthController::class,"ShowRegisterForm"])->name("register");
Route::post("/register",[AuthController::class,"register"])->name("register.form");
Route::get("/logout",[AuthController::class,"logout"])->name("logout");
Route::get('/services/page', [ServiceController::class, 'index'])->name('services.index');
Route::get('/learn-more', function () { return view('learn-more');})->name('learn.more');
Route::get('/privacy-policy', function () { return view('privacy-policy');})->name('privacy.policy');
Route::get('/about', function () { return view('about');})->name('about');


Route::middleware(['auth'])->group( function () {
    Route::get("/dashboard",[DashboardController::class,"index"])->name("dashboard");
});

Route::middleware(['auth',HomeownerMiddleware::class])->group( function () {
    Route::get('/appointments/create', [AppointmentController::class,'createAppointment'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    //Route::get('/damages/create',[DamageController::class,'create'])->name('damages.create');
    //Route::post('/damages', [DamageController::class, 'store'])->name('damages.store');
    Route::get('/damages/{id}/edit', [DamageController::class, 'edit'])->name('damages.edit');
    Route::put('/damages/{id}', [DamageController::class, 'update'])->name('damages.update');
    Route::delete('/damages/{id}', [DamageController::class, 'destroy'])->name('damages.destroy');
    Route::get('/damages/{id}/add-images', [DamageController::class, 'addImages'])->name('damages.addimages');
    Route::post('/damages/{id}/store-images', [DamageController::class, 'storeImages'])->name('damages.storeimages');
    Route::delete('/damage-images/{id}', [DamageController::class, 'deleteImage'])->name('damages.images.destroy');

    Route::get('/damage-report/start', [PersonalReportController::class, 'create'])->name('damage.report.prompt');
    Route::post('/damage-report/start', [PersonalReportController::class, 'store'])->name('damage.report.store');

    Route::get('/damage-report/{id}/add-damages', [DamageController::class, 'addDamagesForm'])->name('damage.report.addDamages');
    Route::post('/damage-report/{id}/store-damages', [DamageController::class, 'storeDamages'])->name('damage.report.storeDamages');

    Route::get('/damage-report/{id}', [DamageController::class, 'showReport'])->name('damage.report.show');
    Route::get('/damage/{id}/view', [DamageController::class, 'show'])->name('damage.view');

});
//Route::post('/admin/damages/{damage}/accept', [DamageController::class, 'accept'])->name('damages.accept');
//Route::post('/admin/damages/{damage}/decline', [DamageController::class, 'decline'])->name('damages.decline');
Route::get('/admin/damages', [DamageController::class, 'index'])->name('damages.index');



Route::middleware(['auth',ServiceProviderMiddleware::class])->group( function () {
    Route::get('/provider/appointments', [AppointmentController::class, 'providerAppointments'])->name('provider.appointments');
    Route::post('/appointments/{id}/accept', [AppointmentController::class, 'accept'])->name('appointment.accept');
    Route::post('/appointments/{id}/decline', [AppointmentController::class, 'decline'])->name('appointment.decline');
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
    Route::get('/service/products', [ProductController::class, 'index'])->name('products.index');
    

});

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/admin/damage-reports', [DamageController::class, 'index'])->name('damages.index');
    Route::get('/service/products', [ProductController::class, 'index'])->name('products.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/admin/providers', [ServiceController::class, 'listProviders'])->name('providers.index');
    Route::get('/admin/providers/{id}', [ServiceController::class, 'showProvider'])->name('providers.show');
    Route::delete('/admin/providers/{id}', [ServiceController::class, 'destroyProvider'])->name('providers.destroy');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});



Route::get('/contracts/{contract}', [ContractController::class, 'show'])->name('contract.view');
Route::get('/appointments/{appointment}/contract', [ContractController::class, 'showByAppointment'])->name('contract.byAppointment');
Route::post('/contracts/{id}/work', [ContractController::class, 'storeWork'])->name('contract.storeWork');
Route::delete('/contracts/{contract}/work/{work}', [ContractController::class, 'destroyWork'])->name('contract.work.destroy');
Route::get('/contracts/{contract}/work/{work}/edit', [ContractController::class, 'editWork'])->name('contract.work.edit');
Route::put('/contracts/{contract}/work/{work}', [ContractController::class, 'updateWork'])->name('contract.work.update');
Route::delete('/contracts/work-image/{id}', [ContractController::class, 'destroyWorkImage'])->name('contract.work.image.destroy');
Route::put('/contracts/{id}/status', [ContractController::class, 'updateStatus'])->name('contract.updateStatus');

Route::get('/appointments/{id}/damage-report', [AppointmentController::class, 'showDamageDetails'])->name('appointments.damage-report');

Route::get('/personal-report/create', [PersonalReportController::class, 'create'])->name('personal.report.create');
Route::post('/personal-report/store', [PersonalReportController::class, 'store'])->name('personal.report.store');
Route::get('/personal-report/{id}/edit', [PersonalReportController::class, 'edit'])->name('personal.report.edit');
Route::put('/personal-report/{id}', [PersonalReportController::class, 'update'])->name('personal.report.update');


Route::get('/services/{service}', [ServiceController::class, 'show'])->name('service.show');
Route::get('/provider/profile', [ServiceController::class, 'editProfile'])->name('provider.profile.edit');
Route::put('/provider/profile', [ServiceController::class, 'updateProfile'])->name('provider.profile.update');

Route::middleware(['auth', GovernmentMiddleware::class])->prefix('government')->name('government.')->group(function () {
    Route::get('/dashboard', [GovernmentController::class, 'dashboard'])->name('dashboard');
    Route::get('/damages/{damage}/images', [DamageController::class, 'showImages'])->name('damages.images');
    Route::post('/damages/{damage}/accept', [DamageController::class, 'accept'])->name('damages.accept');
    Route::post('/damages/{damage}/decline', [DamageController::class, 'decline'])->name('damages.decline');
    Route::get('/damageReports/{user}', [GovernmentController::class, 'showDamageReports'])->name('damageReports.show');
    Route::get('/contracts/{contract}', [GovernmentController::class, 'showContract'])->name('contracts.show');
});
