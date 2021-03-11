<?php


namespace Project\Router;

/**
 * Class Route
 * @package Project\Router
 */
class Route
{
    /**
     * @var string Name of the route
     */
    private $name;

    /**
     * @var string Path of the route
     */
    private $path;

    /**
     * @var string The action to perform
     */
    private $action;

    public $matches;
    /**
     * Route constructor.
     * @param $name string The name of the route
     * @param $path string The path of the route
     */
    public function __construct(string $name, string $path, string $action)
    {
        $this->name = $name;
        $this->path = $path;
        $this->action = "Project\Controller\\" . $action;
    }

    /**
     * @return string Return the name of the route
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string Return the path of the route
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string Return the action of the route
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Compares the path in param to the routes and return a bool, true if the paths are equals, false otherwise.
     * @param $path
     * @return bool
     */
    public function matches($path): bool
    {
        $new = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $pathToMatch = "#^$new$#";
        if (preg_match($pathToMatch, $path, $matches)) {
            $this->matches = $matches;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Execute the action of the route
     */
    public function execute()
    {
        $params = explode('@', $this->action);
        $controller = new $params[0]();
        $method = $params[1];
        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
}
