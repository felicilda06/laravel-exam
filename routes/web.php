<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AnnouncementController;

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


//Protected Routes
Route::prefix('announcement')->middleware('authorization')->group(function(){
    Route::get('/', [AnnouncementController::class, 'index']);
    Route::get('/{id}', [AnnouncementController::class, 'getById']);
    Route::put('/{id}', [AnnouncementController::class, 'update']);
    Route::delete('/{id}', [AnnouncementController::class, 'delete']);
    Route::post('/add', [AnnouncementController::class, 'store']);
});


Route::get('/' , [MainController::class, 'index']);
Route::get('/signin' , [MainController::class, 'signin']);
Route::get('/signout' , [MainController::class, 'signout']);
Route::post('/login' , [MainController::class, 'login']);
Route::get('/register' , [MainController::class, 'register']);
Route::post('/register' , [MainController::class, 'store']);
