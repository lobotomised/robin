<?php

declare(strict_types=1);

use App\Http\Controllers\PastApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(static function (): void {
    Route::post('/past', [PastApiController::class, 'store'])->name('api.past.store');
});
