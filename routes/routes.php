<?php

/** @var $router \App\App\Router */

/**
 * WEB ROUTES
 */
$router->get('', 'TaskController@index');
$router->get('tasks', 'TaskController@index');

$router->get('tasks/create', 'TaskController@create');
$router->post('tasks/store', 'TaskController@store');

$router->get('tasks/edit', 'TaskController@edit');
$router->post('tasks/edit', 'TaskController@update');

$router->get('tasks/delete', 'TaskController@delete');

$router->get('tasks/calendar', 'TaskController@calendar');


/**
 * API ROUTES
 */
$router->get('api/tasks', 'Api\TaskController@index');
$router->post('api/tasks/store', 'Api\TaskController@store');
$router->post('api/tasks/edit', 'Api\TaskController@update');
$router->get('api/tasks/delete', 'Api\TaskController@delete');