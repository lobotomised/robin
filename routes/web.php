<?php

Route::get('/', [
    'as'   => 'past.create',
    'uses' => 'PastController@create',
]);

Route::get('/past/{past}', [
    'as'   => 'past.view',
    'uses' => 'PastController@view',
]);
