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
use App\Http\Controllers\AgricultureController;
use App\Http\Controllers\PeaceAndOrderController;
use App\Http\Controllers\HealthAndNutritionController;

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

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
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