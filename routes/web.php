<?php

use App\Http\Controllers\PlanCompareController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PlanCompareController::class, 'index'])->name('compare.index');
