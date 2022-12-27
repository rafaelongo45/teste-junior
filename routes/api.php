<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'v1'], function () {
    //Get Routes
    Route::get('/pessoa', 'Api\PessoaController@index');
    Route::get('/pessoa/{id}', 'Api\PessoaController@show')->where('id', '[1-9]+');

    //Post Route
    Route::post('/pessoa', 'Api\PessoaController@store');

    //Update Route
    Route::put('/pessoa/{id}', 'Api\PessoaController@update');

    //Delete Route
    Route::delete('pessoa/{id}', 'Api\PessoaController@destroy');
    }
);
