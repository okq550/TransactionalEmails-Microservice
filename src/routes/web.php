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


$router->get('user/{id}', 'ExampleController@show');

$router->post('/register', function (\Illuminate\Http\Request $request)
{
    // if ($request->isJson()) {
        $data = $request->json()->all();
    // } else {
    //     $data = $request->all();
    // }

    dd($data{'first_name'});
});