<?php

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post("users/register", [UserController::class, 'store'])->name("register");
Route::post("login", [AuthController::class, 'login'])->name("login");



//require login
Route::middleware('auth:api')->group(function () {

//users.
Route::prefix("users")->group(function () {
    Route::get("/", [UserController::class, 'index'])->name("users");
    });

//Profiles.
Route::prefix("profiles")->group(function () {
    Route::get("/", [ProfileController::class, 'index'])->name("users");
    Route::post("/register", [ProfileController::class, 'store'])->name("register");
    });
});




