<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('transactions.index');
});

Route::get('transactions/datatable', [TransactionController::class, 'datatable'])->name('transactions.datatable');
// Route::resource('transactions', TransactionController::class)->only(['index', 'store', 'destroy']);
Route::resource('transactions', TransactionController::class);
Route::get('categories/{type}', [CategoryController::class, 'getByType'])->name('categories.byType');
