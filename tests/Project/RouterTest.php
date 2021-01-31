<?php


namespace Tests\Project;

use PHPUnit\Framework\TestCase;
use Project\Router\Route;
use Project\Router\RouteAlreadyExistsException;
use Project\Router\Router;

class RouterTest extends TestCase
{
    private $router;

    public function setUp(): void
    {
        $this->router = new Router();
    }

    public function testGetRoutes()
    {
        $this->assertCount(0, $this->router->getRoutes());
    }

    public function testAddRoute()
    {
        $this->assertCount(0, $this->router->getRoutes());
        $this->router->addRoute(new Route("Nom", "chemin", function () {
        }));
        $this->assertCount(1, $this->router->getRoutes());
    }

    public function testCantAddAnExistingRoute()
    {
        $route = new Route("Nom", "chemin", function () {
        });
        $this->router->addRoute($route);
        $this->expectException(RouteAlreadyExistsException::class);
        $this->router->addRoute($route);
    }

    public function testGetRoute()
    {
        $route = new Route("Nom", "chemin", function () {
        });
        $this->router->addRoute($route);
        $this->assertEquals($route, $this->router->getRoute("Nom"));
    }

    public function testMatch()
    {
        $route = new Route("Nom", "/", function () {
        });
        $this->router->addRoute($route);
        $this->assertEquals($route, $this->router->match('/'));
    }
}
