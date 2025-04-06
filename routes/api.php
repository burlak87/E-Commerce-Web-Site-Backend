<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware(['middleware' => 'admin'])->group(function () { 
    Route::get('/profile/admin', function () {
        return view('admin');
    })->name('admin_panel');
});