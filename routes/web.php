<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'AfspraakController@getIndex')->name('afspraak.index');

Route::get('/afspraken', 'AfspraakController@getAfspraken')->name('afspraak.afspraken');

Route::post('/wijzig-afspraak', 'AfspraakController@postWijzigAfspraak')->name('afspraak.wijzig');

Route::post('/add-afspraak', 'AfspraakController@postAddAfspraak')->name('afspraak.add');