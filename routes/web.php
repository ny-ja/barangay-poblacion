<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DRRMController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\AgricultureController;
use App\Http\Controllers\PeaceAndOrderController;
use App\Http\Controllers\HealthAndNutritionController;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.index');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact.index');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');

Route::prefix('committee')->group(function () {
    Route::get('/agriculture', [AgricultureController::class, 'index'])->name('committee.agriculture.index');
    Route::get('/health-nutrition', [HealthAndNutritionController::class, 'index'])->name('committee.health.index');
    Route::get('/peace-order', [PeaceAndOrderController::class, 'index'])->name('committee.peace.index');
    Route::get('/education', [EducationController::class, 'index'])->name('committee.education.index');
    Route::get('/drrm', [DRRMController::class, 'index'])->name('committee.drrm.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('admin.index');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');