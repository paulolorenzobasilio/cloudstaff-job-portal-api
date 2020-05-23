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

$router->group(['prefix' => 'employer/jobs', 'middleware' => 'auth:employer'], function ($router) {
    $router->get('/', 'EmployerController@index');
    $router->post('/', 'EmployerController@create');
    $router->delete('{id}', 'EmployerController@destroy');
    $router->get('{id}', 'EmployerController@show');
    $router->get('{id}/applicants', 'EmployerController@listApplicants');
    $router->put('{id}/posted', 'EmployerController@posted');
});

$router->group(['prefix' => 'employer/auth'], function ($router) {
    $router->post('login', 'Auth\EmployerController@login');
    $router->get('me', 'Auth\EmployerController@me');
    $router->post('logout', 'Auth\EmployerController@logout');
});
