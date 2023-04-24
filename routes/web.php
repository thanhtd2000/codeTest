<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
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

Route::get("/", [HomeController::class, 'index'])->name('client.home');
Route::get("/buy-ticket/{id}", [HomeController::class, 'schedule'])->name('buyticket');
Route::post("/complete-order", [HomeController::class, 'order'])->name('order');

// login routes
Route::get("/login", [AuthController::class, 'getLogin'])->name('login');
Route::post("/login", [AuthController::class, 'checkLogin'])->name('checkLogin');
Route::get("/dang-ky", [AuthController::class, 'getSignup']);
Route::post("/signup", [AuthController::class, 'store'])->name('user.dangky');
Route::get("/logout", [AuthController::class, 'Logout'])->name('logout');
//admin routes
Route::middleware('checkAdmin')->prefix('admin')->group(function () {
    Route::get("/index", [UserController::class, 'index'])->name('admin.index');
    Route::prefix('users')->group(function () {
        Route::get("/index", [UserController::class, 'show'])->name('users.show');
        Route::post("/index", [UserController::class, 'search'])->name('users.search');
        Route::get("/create", [UserController::class, 'create'])->name('users.create');
        Route::post("/create", [UserController::class, 'store'])->name('user.post');
        Route::get("/delete/{id}", [UserController::class, 'delete']);
        Route::get("/edit/{id}", [UserController::class, 'edit']);
        Route::put("/update", [UserController::class, 'update'])->name('user.update');
        Route::get("/permise", [UserController::class, 'permise'])->name('users.permise');
        Route::middleware('checkAdminPermission')->get("/permise1", [UserController::class, 'permise_admin'])->name('users.permise1');
    });
    Route::prefix('film')->group(function () {
        Route::get("/index", [FilmController::class, 'index'])->name('film.show');
        Route::post("/index", [FilmController::class, 'search'])->name('film.search');
        Route::get("/create", [FilmController::class, 'create'])->name('film.create');
        Route::post("/create", [FilmController::class, 'store'])->name('film.post');
        Route::get("/delete/{id}", [FilmController::class, 'delete']);
        Route::get("/edit/{id}", [FilmController::class, 'edit']);
        Route::post("/index", [FilmController::class, 'search'])->name('film.search');
        Route::put("/update", [FilmController::class, 'update'])->name('film.update');
    });
    Route::prefix('room')->group(function () {
        Route::get("/index", [RoomController::class, 'index'])->name('room.show');
        Route::post("/index", [RoomController::class, 'search'])->name('room.search');
        Route::get("/create", [RoomController::class, 'create'])->name('room.create');
        Route::post("/create", [RoomController::class, 'store'])->name('room.post');
        Route::get("/delete/{id}", [RoomController::class, 'destroy']);
        Route::get("/edit/{id}", [RoomController::class, 'edit']);
        Route::post("/index", [RoomController::class, 'search'])->name('room.search');
        Route::put("/update", [RoomController::class, 'update'])->name('room.update');
    });
    Route::prefix('schedule')->group(function () {
        Route::get("/index", [ScheduleController::class, 'index'])->name('schedule.show');
        Route::post("/index", [ScheduleController::class, 'search'])->name('schedule.search');
        Route::get("/create", [ScheduleController::class, 'create'])->name('schedule.create');
        Route::post("/create", [ScheduleController::class, 'store'])->name('schedule.post');
        Route::get("/delete/{id}", [ScheduleController::class, 'destroy']);
        Route::get("/edit/{id}", [ScheduleController::class, 'edit']);
        Route::post("/index", [ScheduleController::class, 'search'])->name('schedule.search');
        Route::put("/update", [ScheduleController::class, 'update'])->name('schedule.update');
    });
});
