<?php

class Config
{
    private static $instance = null;
    private $parameters;
    private $routes;

    private function __construct()
    {
        require (__DIR__ . '/../config/parameters.php');
        require (__DIR__ . '/../config/routing.php');

        $this->parameters = $parameters;
        $this->routes     = $routes;
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    public function getParameter($parameter)
    {
        return $this->parameters[$parameter];
    }

    public function getRoute($route)
    {
        return $this->routes[$route];
    }
}
