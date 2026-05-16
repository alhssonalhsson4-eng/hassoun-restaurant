<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DeliveryAreaController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageImageController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\LocationController;

/*
|--------------------------------------------------------------------------
| Front Website
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/about', [HomeController::class, 'about'])
    ->name('about');

Route::get('/ratings-page', [HomeController::class, 'ratingsPage'])
    ->name('ratings.page');

Route::get('/location-page', [HomeController::class, 'locationPage'])
    ->name('location.page');

Route::get('/menu-page', [HomeController::class, 'menuPage'])
    ->name('menu.page');

Route::post('/save-order', [HomeController::class, 'saveOrder'])
    ->name('save.order');

/*
|--------------------------------------------------------------------------
| AI Assistant
|--------------------------------------------------------------------------
*/

Route::match(['get', 'post'], '/ai-search', [HomeController::class, 'aiSearch'])
    ->name('ai.search');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings.index');

    Route::post('/settings', [SettingController::class, 'update'])
        ->name('settings.update');

    /*
    |--------------------------------------------------------------------------
    | Printer
    |--------------------------------------------------------------------------
    */

    Route::get('/printer-settings', [SettingController::class, 'printer'])
        ->name('printer.index');

    Route::post('/printer-settings', [SettingController::class, 'updatePrinter'])
        ->name('printer.update');

    /*
    |--------------------------------------------------------------------------
    | AI Assistant Settings
    |--------------------------------------------------------------------------
    */

    Route::get('/ai-assistant', [SettingController::class, 'aiAssistant'])
        ->name('ai.assistant');

    Route::post('/ai-assistant', [SettingController::class, 'updateAiAssistant'])
        ->name('ai.assistant.update');

    /*
    |--------------------------------------------------------------------------
    | Location
    |--------------------------------------------------------------------------
    */

    Route::get('/location', [LocationController::class, 'index'])
        ->name('location.index');

    Route::post('/location/update', [LocationController::class, 'update'])
        ->name('location.update');

    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */

    Route::resource('categories', CategoryController::class);

    /*
    |--------------------------------------------------------------------------
    | Items
    |--------------------------------------------------------------------------
    */

    Route::resource('items', ItemController::class);

    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */

    Route::resource('orders', OrderController::class);

    /*
    |--------------------------------------------------------------------------
    | Delivery Areas
    |--------------------------------------------------------------------------
    */

    Route::resource('delivery-areas', DeliveryAreaController::class);

    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */

    Route::resource('pages', PageController::class);

    /*
    |--------------------------------------------------------------------------
    | Page Images
    |--------------------------------------------------------------------------
    */

    Route::get('/pages/{page}/images',
        [PageImageController::class, 'index'])
        ->name('pages.images');

    Route::post('/pages/{page}/images',
        [PageImageController::class, 'store'])
        ->name('pages.images.store');

    Route::get('/page-images/{image}/edit',
        [PageImageController::class, 'edit'])
        ->name('page-images.edit');

    Route::put('/page-images/{image}',
        [PageImageController::class, 'update'])
        ->name('page-images.update');

    Route::delete('/page-images/{image}',
        [PageImageController::class, 'destroy'])
        ->name('page-images.destroy');

    /*
    |--------------------------------------------------------------------------
    | Ratings
    |--------------------------------------------------------------------------
    */

    Route::get('/ratings', [RatingController::class, 'index'])
        ->name('ratings.index');

    Route::post('/ratings/category',
        [RatingController::class, 'storeCategory'])
        ->name('ratings.category.store');

    Route::put('/ratings/category/{category}',
        [RatingController::class, 'updateCategory'])
        ->name('ratings.category.update');

    Route::delete('/ratings/category/{category}',
        [RatingController::class, 'destroyCategory'])
        ->name('ratings.category.delete');

    Route::post('/ratings/option',
        [RatingController::class, 'storeOption'])
        ->name('ratings.option.store');

    Route::put('/ratings/option/{option}',
        [RatingController::class, 'updateOption'])
        ->name('ratings.option.update');

    Route::delete('/ratings/option/{option}',
        [RatingController::class, 'destroyOption'])
        ->name('ratings.option.delete');
});

require __DIR__.'/auth.php';