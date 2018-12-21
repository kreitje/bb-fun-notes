<?php

$router->group(['middleware' => ['web']], function($router) {

    $router->get('login', 'SessionController@create')->name('login');
    $router->post('login', 'SessionController@store');
    $router->any('logout', 'SessionController@destroy');

    $router->group(['middleware' => ['auth']], function($router) {
        $router->get('/', 'NoteController@index');
        $router->post('notes', 'NoteController@store');
        $router->put('notes/{id}', 'NoteController@update');
        $router->delete('notes/{id}', 'NoteController@destroy');
    });
});