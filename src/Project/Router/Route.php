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

    /**
     * Route constructor.
     * @param $name string The name of the route
     * @param $path string The path of the route
     */
    public function __construct(string $name, string $path, string $action)
    {
        $this->name = $name;
        $this->path = $path;
        $this->action = $action;
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
}
