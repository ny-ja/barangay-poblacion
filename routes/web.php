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
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\CommitteeController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\HealthAndNutritionController;
use App\Http\Controllers\Admin\CommitteeMemberController;
use App\Http\Controllers\Admin\BarangayOfficialController;
use App\Http\Controllers\Admin\DocumentCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;

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
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/news-categories', [NewsCategoryController::class, 'index'])->name('admin.news-categories.index');
    Route::post('/news-categories', [NewsCategoryController::class, 'store'])->name('admin.news-categories.store');
    Route::put('/news-categories/{category}', [NewsCategoryController::class, 'update'])->name('admin.news-categories.update');
    Route::delete('/news-categories/{category}', [NewsCategoryController::class, 'destroy'])->name('admin.news-categories.destroy');

    Route::get('/news', [AdminNewsController::class, 'index'])->name('admin.news.index');
    Route::post('/news', [AdminNewsController::class, 'store'])->name('admin.news.store');
    Route::put('/news/{news}', [AdminNewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{news}', [AdminNewsController::class, 'destroy'])->name('admin.news.destroy');

    Route::get('/document-categories', [DocumentCategoryController::class, 'index'])->name('admin.document-categories.index');
    Route::post('/document-categories', [DocumentCategoryController::class, 'store'])->name('admin.document-categories.store');
    Route::put('/document-categories/{category}', [DocumentCategoryController::class, 'update'])->name('admin.document-categories.update');
    Route::delete('/document-categories/{category}', [DocumentCategoryController::class, 'destroy'])->name('admin.document-categories.destroy');

    Route::get('/document-types', [DocumentTypeController::class, 'index'])->name('admin.document-types.index');
    Route::post('/document-types', [DocumentTypeController::class, 'store'])->name('admin.document-types.store');
    Route::put('/document-types/{type}', [DocumentTypeController::class, 'update'])->name('admin.document-types.update');
    Route::delete('/document-types/{type}', [DocumentTypeController::class, 'destroy'])->name('admin.document-types.destroy');

    Route::get('/documents', [DocumentController::class, 'index'])->name('admin.documents.index');
    Route::post('/documents', [DocumentController::class, 'store'])->name('admin.documents.store');
    Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('admin.documents.update');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('admin.documents.destroy');

    Route::get('/barangay-officials', [BarangayOfficialController::class, 'index'])->name('admin.barangay-officials.index');
    Route::post('/barangay-officials', [BarangayOfficialController::class, 'store'])->name('admin.barangay-officials.store');
    Route::put('/barangay-officials/{official}', [BarangayOfficialController::class, 'update'])->name('admin.barangay-officials.update');
    Route::delete('/barangay-officials/{official}', [BarangayOfficialController::class, 'destroy'])->name('admin.barangay-officials.destroy');

    Route::get('/committees', [CommitteeController::class, 'index'])->name('admin.committees.index');
    Route::post('/committees', [CommitteeController::class, 'store'])->name('admin.committees.store');
    Route::put('/committees/{committee}', [CommitteeController::class, 'update'])->name('admin.committees.update');
    Route::delete('/committees/{committee}', [CommitteeController::class, 'destroy'])->name('admin.committees.destroy');

    Route::get('/committee-members', [CommitteeMemberController::class, 'index'])->name('admin.committee-members.index');
    Route::post('/committee-members', [CommitteeMemberController::class, 'store'])->name('admin.committee-members.store');
    Route::put('/committee-members/{member}', [CommitteeMemberController::class, 'update'])->name('admin.committee-members.update');
    Route::delete('/committee-members/{member}', [CommitteeMemberController::class, 'destroy'])->name('admin.committee-members.destroy');
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');