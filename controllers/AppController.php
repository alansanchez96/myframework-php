<?php

namespace Controllers;

use MVC\Router;

class AppController
{
    public static function index(Router $router)
    {
        $router->render('pages/index');
    }

    public static function notFound(Router $router)
    {
        $router->render404();
    }
}
