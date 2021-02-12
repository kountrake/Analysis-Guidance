<?php

namespace Project;

use GuzzleHttp\Psr7\Response;
use Project\Router\Router;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class App
 * @package Project
 */
class App
{

    /**
     * @var array
     */
    //private $modules;

    private $router;

    /**
     * App constructor.
     */
    public function __construct()
    {
//      $this->modules = [];
        $this->router = new Router();
//        foreach ($this->modules as $module) {
//            $temp = new $module($this->router);
//            $temp->mapRoutes();
//        }
    }


    /**
     * @param ServerRequestInterface $request
     */
    public function run(ServerRequestInterface $request)
    {
        $path = str_replace('/~naessens', '', $request->getUri()->getPath());
        $this->router->addRoute('GET', 'home', '/', 'HomeController@index');
        $this->router->addRoute('GET', 'home_index', '/index', 'HomeController@index');
        $this->router->addRoute('GET', 'dashboard_index', '/dashboard', 'DashboardController@index');
        $this->router->addRoute('GET', 'help_index', '/help', 'HelpController@index');
        $this->router->addRoute('GET', 'login', '/login', 'LoginController@index');
        $this->router->addRoute('POST', 'login_connexion', '/login', 'LoginController@index');
        $this->router->addRoute('GET', 'register', '/register', 'RegisterController@index');
        $this->router->addRoute('POST', 'register_post', '/register', 'RegisterController@index');
        $this->router->addRoute('POST', 'logout', '/logout', 'LoginController@logout');
        $route = $this->router->match($path, $request->getMethod());
        $route->execute();
    }
}
