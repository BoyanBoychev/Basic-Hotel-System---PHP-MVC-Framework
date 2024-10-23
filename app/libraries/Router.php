<?php

class Router
{
    protected $routes = [];

    public function add($route, $callback)
    {
        //echo "Adding route: $route<br>";  // Debugging message
        $this->routes[$route] = $callback;
    }

    public function dispatch($url)
    {
        // Split the URL into path and query parts
        $urlParts = explode('?', $url);
        $path = $urlParts[0]; // Get the path part of the URL

        foreach ($this->routes as $route => $callback) {
            // Check for dynamic parameter {id}
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route);
            if (preg_match('#^' . $pattern . '$#', $path, $matches)) {
                array_shift($matches);

                // Create an instance of the controller if not static
                if (is_array($callback)) {
                    $controllerName = $callback[0];
                    $methodName = $callback[1];

                    // Check if the controller class exists
                    if (!class_exists($controllerName)) {
                        echo "Controller class '$controllerName' not found!";
                        return;
                    }

                    // Create a new instance of the controller
                    $controller = new $controllerName();
                    return call_user_func_array([$controller, $methodName], $matches);
                }
                return call_user_func_array($callback, $matches);
            }
        }
        echo "404 - Route not found";
    }
}
