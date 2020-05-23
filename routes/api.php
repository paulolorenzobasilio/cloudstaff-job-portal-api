<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function ($router) {
    $router->post('create-admin', 'AdminController@createAdmin');
    $router->post('create-employer', 'AdminController@createEmployer');
});

$router->group(['prefix' => 'admin/auth'], function ($router) {
    $router->post('login', 'Auth\AdminController@login');
    $router->get('me', 'Auth\AdminController@me');
    $router->post('logout', 'Auth\AdminController@logout');
});

$router->group(['prefix' => 'employer/jobs', 'middleware' => 'auth:employer'], function($router) {
    $router->get('/', 'JobController@index');
    $router->get('{id}', 'JobController@show');
    $router->post('/', 'JobController@create');
    $router->delete('/{id}', 'JobController@destroy');
});

$router->group(['prefix' => 'employer/auth'], function ($router) {
    $router->post('login', 'Auth\EmployerController@login');
    $router->get('me', 'Auth\EmployerController@me');
    $router->post('logout', 'Auth\EmployerController@logout');
});
