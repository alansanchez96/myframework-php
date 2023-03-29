<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];

    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function checkRoutes()
    {
        session_start();

        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        $fn = $this->getMethodRoute($currentUrl, $method);

        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();

        include_once __DIR__ . "/views/$view.php";
        $content = ob_get_clean();
        include_once __DIR__ . '/views/layout.php';
    }

    public function render404()
    {
        include_once __DIR__ . '/views/pages/404.php';
    }

    private function getMethodRoute($currentUrl, $method)
    {
        if ($method === 'GET') {
            return $this->getRoutes[$currentUrl] ?? null;
        } else {
            return $this->postRoutes[$currentUrl] ?? null;
        }
    }
}
