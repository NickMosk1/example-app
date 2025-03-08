<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class);

Route::get('/login', \App\Livewire\Login::class)->name('login');

Route::get('/users', \App\Livewire\Users::class);
