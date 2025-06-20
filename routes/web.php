<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', \App\Livewire\Login::class)->name('login');
    Route::get('/register', \App\Livewire\Register::class)->name('register');
});

Route::prefix('users')->middleware('auth')->group(function () {
    Route::get('/table', \App\Livewire\UsersTable::class)->name('users.table');
    Route::get('/create', \App\Livewire\CreateUser::class)->name('users.create');
});

Route::prefix('partners')->middleware('auth')->group(function () {
    Route::get('/table', \App\Livewire\PartnersTable::class)->name('partners.table');
    Route::get('/create', \App\Livewire\CreatePartner::class)->name('partners.create');
});

Route::prefix('leads')->middleware('auth')->group(function () {
    Route::get('/table', \App\Livewire\LeadsTable::class)->name('leads.table');
    Route::get('/table/byPartner', \App\Livewire\LeadsTableByPartnerId::class)->name('leads.table.by.partner');
    Route::get('/create', \App\Livewire\CreateLead::class)->name('leads.create');
    
    Route::prefix('sources')->group(function () {
        Route::get('/table', \App\Livewire\LeadSourcesTable::class)->name('leads.sources.table');
        Route::get('/create', \App\Livewire\CreateLeadSource::class)->name('leads.sources.create');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/adminPanel', \App\Livewire\AdminPanel::class)->name('admin.panel');
    
    Route::prefix('account')->group(function () {
        Route::get('/', \App\Livewire\Account::class)->name('account');
        Route::put('/update', \App\Livewire\Account::class)->name('account.update');
    });
});