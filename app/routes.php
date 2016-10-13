<?php

Route::get('/', ['as' => 'index', 'uses' => 'GeneratorController@getIndex']);
Route::post('generator', ['as' => 'generator', 'uses' => 'GeneratorController@postGenerator']);
Route::get('word', ['as' => 'word', 'uses' => 'GeneratorController@generateWord']);

