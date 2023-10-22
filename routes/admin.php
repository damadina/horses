<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;



Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('',[HomeController::class,'index'])->name('admin.home');
    Route::resource('roles',RoleController::class)->names('admin.roles');
    Route::resource('users',UserController::class)->only('index','edit','update')->names('admin.users');
});

