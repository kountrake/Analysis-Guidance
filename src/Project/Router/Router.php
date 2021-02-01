<?php


namespace Project\Router;

class Router
{
    /**
     * @var Route[] Array of the routes
     */
    private $routes;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->routes = [];
    }


    /**
     * Adds a new Route to the routes array if the route does not already exist
     * @param string $methode The method that the route uses
     * @param string $name The name of the route
     * @param string $path The path of the route
     * @param string $action The action of the route
     * @throws RouteAlreadyExistsException
     */
    public function addRoute(string $methode, string $name, string $path, string $action)
    {
        if (!(isset($this->routes[$methode]))) {
            $this->routes[$methode] = [];
        }
        foreach ($this->routes[$methode] as $route) {
            if ($route->getName() === $name) {
                throw new RouteAlreadyExistsException();
            }
        }
        $this->routes[$methode][] = new Route($name, $path, $action);
    }

    /**
     * Gets all the routes
     * @return Route[] Return an array of the routes
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * Gets a route by its name
     * @param string $name
     * @return Route
     */
    public function getRoute(string $name): Route
    {
        foreach ($this->routes as $routes) {
            foreach ($routes as $route) {
                if ($route->getName() === $name) {
                    return $route;
                }
            }
        }
        return new Route("404", '/404', function () {
        });
    }

    public function match(string $path, string $methode): Route
    {
        foreach ($this->routes[$methode] as $route) {
            if ($route->matches($path)) {
                return $route;
            }
        }
        return new Route("404", '/404', 'ErrorController@doesNotExist');
    }
}
