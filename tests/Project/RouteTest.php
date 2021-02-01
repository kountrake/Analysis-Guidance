<?php


namespace Tests\Project;

use PHPUnit\Framework\TestCase;
use Project\Router\Route;
use Project\Tools\TestTools;

class RouteTest extends TestCase
{

    private $route;

    public function setUp(): void
    {
        $this->route = new Route("test", "path", '\Tests\Project\Tools\TestTools@index');
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
        $this->assertEquals('\Tests\Project\Tools\TestTools@index', $this->route->getAction());
    }

    public function testExecute()
    {
        $this->assertEquals('it works!', $this->route->execute());
    }
}
