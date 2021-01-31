<?php


namespace Tests\Project;

use PHPUnit\Framework\TestCase;
use Project\Router\Route;

class RouteTest extends TestCase
{

    private $route;

    public function setUp(): void
    {
        $this->route = new Route("test", "path", 'MonController@fonction');
    }

    public function testGetName()
    {
        $this->assertEquals("test", $this->route->getName());
    }

    public function testGetPath()
    {
        $this->assertEquals("path", $this->route->getPath());
    }

    public function testGetAction()
    {
        $this->assertEquals('MonController@fonction', $this->route->getAction());
    }
}
