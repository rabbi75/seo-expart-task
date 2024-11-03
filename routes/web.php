<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RecycleProductsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })
Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
Route::get('create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('store', [ProjectController::class, 'store'])->name('projects.store');
Route::post('/file-upload', [ProjectController::class, 'fileUpload'])->name('file.upload');
Route::post('/delete/{id}', [ProjectController::class, 'destroy'])->name('project.delete');


Route::get('/otp', [ProjectController::class, 'sendOTP'])->name('send_otp');


Route::get('/restore', [RecycleProductsController::class, 'index'])->name('project.restore.index');
Route::get('/restore/{id}', [RecycleProductsController::class, 'restore'])->name('project.recycle.restore');
Route::post('/restore/delete/{id}', [RecycleProductsController::class, 'destroy'])->name('project.recycle.delete');

Route::post('/project/recycle/restoreAll', [RecycleProductsController::class, 'restoreAll'])->name('project.recycle.restoreAll');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
