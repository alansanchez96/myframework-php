<?php

namespace Controllers;

use Model\ExampleModel;
use MVC\Router;

class ExampleController
{
    public static function index(Router $router)
    {
        $example = ExampleModel::all();

        $router->render('example/index', [
            'example' => $example
        ]);
    }

    public static function create(Router $router)
    {
        $exampleModel = new ExampleModel;
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exampleModel->syncUp($_POST);

            $alerts = $exampleModel->validateAlerts();

            if (empty($alerts)) {
                $exampleModel->save();

                header('Location: /');
            }
        }

        $router->render('example/create', [
            'example' => $exampleModel,
            'alerts' => $alerts
        ]);
    }

    public static function update(Router $router)
    {
        if (!is_numeric($_GET['id'])) return;

        $exampleModel = ExampleModel::find($_GET['id']);
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exampleModel->syncUp($_POST);

            $alerts = $exampleModel->validateAlerts();

            if (empty($alerts)) {
                $exampleModel->save();

                header('Location: /');
            }
        }

        $router->render('example/update', [
            'example' => $exampleModel,
            'alerts' => $alerts
        ]);
    }

    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            
            $exampleModel = ExampleModel::find($id);
            $exampleModel->delete();

            header('location: /servicios');
        }
    }
}
