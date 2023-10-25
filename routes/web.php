<?php
/**
 * AAWeb.tech
 * https://aaweb.tech
 */

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

// For the demo purpose the middleware verified is not needed, but it's good to have it in a production app.
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', /*'verified'*/])->name('dashboard');

// Admin routes
Route::get('/admin', function() {
    return view('admin.index');
})->middleware(['auth', /*'verified',*/ 'admin'])->name('admin.index');
Route::get('/reports', function() {
    return view('admin.report');
})->middleware(['auth', /*'verified',*/ 'admin'])->name('admin.reports');

// User routes (for demonstration purpose they're served via UserController and the middlewares are also set via the controller in the __construct method. Most routes in a Laravel app would be served via a controller)
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/stats', [UserController::class, 'stats'])->name('user.stats');

// Viewer routes
Route::get('/viewer', function() {
    return view('viewer.index');
})->middleware(['auth', 'viewer'])->name('viewer.index');
Route::get('/products', function() {
    return view('viewer.products');
})->middleware(['auth', 'viewer'])->name('viewer.products');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
