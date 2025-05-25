<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class)->name('home');



Route::get('/login', \App\Livewire\Login::class)->name('login');

Route::get('/register', \App\Livewire\Register::class)->name('register');



Route::get('/users/table', \App\Livewire\UsersTable::class)->name('users.table')->middleware('auth');

Route::get('/users/create', \App\Livewire\CreateUser::class)->name('users.create')->middleware('auth');


Route::get('/partners/table', \App\Livewire\PartnersTable::class)->name('partners.table')->middleware('auth');

Route::get('/partners/create', \App\Livewire\CreatePartner::class)->name('partners.create')->middleware('auth');



Route::get('/leads/table', \App\Livewire\LeadsTable::class)->name('leads.table')->middleware('auth');

Route::get('/leads/table/byPartner', \App\Livewire\LeadsTableByPartnerId::class)->name('leads.table.by.partner')->middleware('auth');

// Route::get('/leads/table/bySource', \App\Livewire\LeadsTableBySourceId::class)->name('leads.table.by.source')->middleware('auth');

Route::get('/leads/create', \App\Livewire\CreateLead::class)->name('leads.create')->middleware('auth');

Route::get('/leads/sources/table', \App\Livewire\LeadSourcesTable::class)->name('leads.sources.table')->middleware('auth');

Route::get('/leads/sources/create', \App\Livewire\CreateLeadSource::class)->name('leads.sources.create')->middleware('auth');



Route::get('/adminPanel', \App\Livewire\AdminPanel::class)->name('admin.panel')->middleware('auth');



Route::get('/account', \App\Livewire\Account::class)->name('account')->middleware('auth');

Route::put('/account/update', \App\Livewire\Account::class)->name('account.update')->middleware('auth');
