<?php

Route::view('/', 'welcome');
Route::view('technologies-i-use', 'tech-stack')->name('tech-stack');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
