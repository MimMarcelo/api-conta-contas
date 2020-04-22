<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It is a breeze. Simply tell Lumen the URIs it should respond to
  | and give it the Closure to call when that URI is requested.
  |
 */

/** @var Laravel\Lumen\Routing\Router $router */
$router->get('/', "UsuarioController@index");

$router->group(['prefix' => 'api'], function() use ($router) {

    $router->post('login', 'UsuarioController@login');
    
    $router->get('periodo/{ano}/{mes}', 'PeriodoController@index');
    
    $router->group(['prefix' => 'contas', 'middleware' => 'auth'], function() use ($router) {

        $router->post('', 'ContasController@store');

        $router->get('', 'ContasController@index');
        $router->get('{id}', 'ContasController@show');
        $router->put('{id}', 'ContasController@update');
        $router->delete('{id}', 'ContasController@destroy');
    });
    $router->group(['prefix' => 'tipos', 'middleware' => 'auth'], function() use ($router) {

        $router->post('', 'TiposController@store');

        $router->get('', 'TiposController@index');
        $router->get('{id}', 'TiposController@show');
        $router->put('{id}', 'TiposController@update');
        $router->delete('{id}', 'TiposController@destroy');
    });
});
