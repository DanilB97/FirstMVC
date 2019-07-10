<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath); //Массив путей
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI']))
            return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function run()
    {
        $uri = $this->getURI();

        //Проверка на наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {

            //Определяем контроллер, action, параметры

            if (preg_match("~$uriPattern~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode('/', $internalRoute);

                //Берем из массива элемент и удаляем его из массива
                $controllerName = ucfirst(array_shift($segments) . 'Controller');

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile))
                    include_once $controllerFile;

                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null)
                    break;

            }

        }
    }

}