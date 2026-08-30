<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\AircraftModelController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\FigureController;
use App\Http\Controllers\WiringController;
use App\Http\Controllers\TorqueController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSectionController;
use App\Http\Controllers\Admin\AdminFigureController;
use App\Http\Controllers\Admin\AdminSpecificationController;
use App\Http\Controllers\Admin\AdminAircraftModelController;
use App\Http\Controllers\Admin\AdminInspectionController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\TranslationController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Translation API
Route::post('/api/translate', [TranslationController::class, 'translate'])->name('api.translate');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Auth Public Aliases
Route::get('/login',     [AdminAuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AdminAuthController::class, 'login'])->name('login.post');
Route::get('/register',  [AdminAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AdminAuthController::class, 'register'])->name('register.post');

// Manual routes
Route::prefix('manual')->name('manual.')->group(function () {
    Route::get('/',                    [ManualController::class, 'index'])->name('index');
    Route::get('/section/{section}',   [ManualController::class, 'section'])->name('section');
    Route::get('/page/{page}',         [ManualController::class, 'page'])->name('page');
});

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Specifications
Route::get('/specifications', [SpecificationController::class, 'index'])->name('specifications');

// Aircraft Models
Route::prefix('models')->name('models.')->group(function () {
    Route::get('/',                    [AircraftModelController::class, 'index'])->name('index');
    Route::get('/lookup',              [AircraftModelController::class, 'lookup'])->name('lookup');
    Route::get('/{model}',             [AircraftModelController::class, 'show'])->name('show');
});

// Inspection
Route::get('/inspection', [InspectionController::class, 'index'])->name('inspection');

// Systems
Route::prefix('systems')->name('systems.')->group(function () {
    Route::get('/',                    [SystemController::class, 'index'])->name('index');
    Route::get('/{system}',            [SystemController::class, 'show'])->name('show');
});

// Figures
Route::prefix('figures')->name('figures.')->group(function () {
    Route::get('/',                    [FigureController::class, 'index'])->name('index');
    Route::get('/{figure}',            [FigureController::class, 'show'])->name('show');
});

// Wiring
Route::get('/wiring', [WiringController::class, 'index'])->name('wiring');

// Torque Values
Route::get('/torque-values', [TorqueController::class, 'index'])->name('torque');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',     [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AdminAuthController::class, 'login'])->name('login.post');
    Route::get('/register',  [AdminAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('register.post');
    Route::post('/logout',   [AdminAuthController::class, 'logout'])->name('logout');
});

// Protected admin
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('sections',       AdminSectionController::class);
    Route::resource('figures',        AdminFigureController::class);
    Route::resource('specifications', AdminSpecificationController::class);
    Route::resource('models',         AdminAircraftModelController::class);
    Route::resource('inspection',     AdminInspectionController::class);
});
