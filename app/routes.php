<?php

Route::get('/', ['as' => 'index', 'uses' => 'GeneratorController@getIndex']);
Route::post('generator', ['as' => 'generator', 'uses' => 'GeneratorController@postGenerator']);

