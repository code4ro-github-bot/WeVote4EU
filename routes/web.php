<?php

declare(strict_types=1);

use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale?}')->group(function () {
    Route::get('/', HomePage::class)->name('home');
});
