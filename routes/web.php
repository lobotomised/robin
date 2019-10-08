<?php

declare(strict_types=1);

use App\Http\Controllers\PastController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PastController::class, 'create'])->name('past.create');

Route::get('/past/{past}', [PastController::class, 'view'])->name('past.view');
