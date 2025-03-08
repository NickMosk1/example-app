<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class);

Route::get('/login', \App\Livewire\Login::class)->name('login');

Route::get('/register', \App\Livewire\CreateUser::class)->middleware('auth');

Route::get('/users/table', \App\Livewire\Users::class)->name('users.table')->middleware('auth');
