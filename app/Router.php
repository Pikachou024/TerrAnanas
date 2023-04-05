<?php

class Router
{
    protected $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function getControllerName($routeName)
    {
        if (isset($this->routes[$routeName])) {
            return $this->routes[$routeName]['controller'];
        }

        return null;
    }

    public function getActionName($routeName)
    {
        if (isset($this->routes[$routeName])) {
            return $this->routes[$routeName]['action'];
        }

        return null;
    }

    public function getPath($routeName)
    {
        if (isset($this->routes[$routeName])) {
            return $this->routes[$routeName]['path'];
        }

        return null;
    }

    public function getBaseTemplate($routeName)
    {
        if (isset($this->routes[$routeName])) {
            return $this->routes[$routeName]['base_template'];
        }

        return null;
    }
}

