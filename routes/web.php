<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('tickets/{ticket}/make-done', [TicketController::class, 'makeDone'])->name('tickets.make-done');

    Route::group(['prefix'=> 'boards'], function () {

        Route::get('/', [BoardController::class, 'index'])->name('boards.index');
        Route::post('/', [BoardController::class, 'store'])->name('boards.store');
        Route::get('/create', [BoardController::class, 'create'])->name('boards.create');
        Route::get('{board}/create-ticket', [BoardController::class, 'createTicket'])->name('boards.create-ticket');
        Route::post('{board}/create-ticket', [BoardController::class, 'storeTicket'])->name('boards.store-ticket');
        Route::post('/', [BoardController::class, 'store'])->name('boards.store');

    });
});

require __DIR__.'/auth.php';
