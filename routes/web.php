<?php

Route::get('/', [
    'as'   => 'past.create',
    'uses' => 'PastController@create'
]);

Route::post('/past', [
    'as'   => 'past.store',
    'uses' => 'PastController@store'
]);

Route::get('/past/{uid}', [
    'as'   => 'past.view',
    'uses' => 'PastController@view'
]);
