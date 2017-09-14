<?php

$router->get('/users', 'UserController@getAll');
$router->get('/users/{slug}', 'UserController@getByslug');
$router->post('/users', 'UserController@create');
$router->put('/users/{slug}', 'UserController@update');
$router->delete('/users/{slug}', 'UserController@delete');

$router->group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function($router) {
    $router->get('/users', 'UserController@getAll');
});
