<?php

Route::view('/', 'welcome');
Route::view('technologies-i-use', 'tech-stack')->name('tech-stack');
Route::view('portfolio', 'portfolio')->name('portfolio');
Route::view('portfolio/gt-transport', 'portfolio.gt-transport')->name('portfolio.gt-transport');
Route::view('portfolio/global-cybersec', 'portfolio.global-cybersec')->name('portfolio.global-cybersec');
Route::view('portfolio/fulcrum-digital', 'portfolio.fulcrum-digital')->name('portfolio.fulcrum-digital');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
