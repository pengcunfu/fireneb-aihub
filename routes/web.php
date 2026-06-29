<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanCompareController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/coding-plan', [PlanCompareController::class, 'index'])->name('compare.index');
