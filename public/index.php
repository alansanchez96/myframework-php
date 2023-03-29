<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AppController;
use Controllers\ExampleController;

$router = new Router();

/**
 * Insert all the routes of your application here
 * methods GET / POST
 */
$router->get('/', [AppController::class, 'index']);
$router->get('/404', [AppController::class, 'notFound']);

// Example
$router->get('/example', [ExampleController::class, 'index']);

$router->get('/example/create', [ExampleController::class, 'create']);
$router->post('/example/create', [ExampleController::class, 'create']);

$router->get('/example/update', [ExampleController::class, 'update']);
$router->post('/example/update', [ExampleController::class, 'update']);

$router->post('/example/delete', [ExampleController::class, 'delete']);


$router->checkRoutes();
