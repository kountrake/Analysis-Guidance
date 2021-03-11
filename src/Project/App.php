<?php

namespace Project;

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
        $this->router->addRoute('POST', 'dashboard_password', '/dashboard/update/password', 'DashboardController@updatePassword');
        $this->router->addRoute('POST', 'dashboard_info', '/dashboard/update/info', 'DashboardController@updateInfo');
        $this->router->addRoute('POST', 'dashboard_delete', '/dashboard/delete/account', 'DashboardController@delete');
        $this->router->addRoute('GET', 'help_index', '/help', 'HelpController@index');
        $this->router->addRoute('GET', 'login', '/login', 'LoginController@index');
        $this->router->addRoute('POST', 'login_connexion', '/login', 'LoginController@login');
        $this->router->addRoute('POST', 'login_logout', '/logout', 'LoginController@logout');
        $this->router->addRoute('GET', 'register', '/register', 'RegisterController@index');
        $this->router->addRoute('POST', 'register_post', '/register', 'RegisterController@register');
        $this->router->addRoute('GET', 'score', '/score', 'ScoreController@index');
        $this->router->addRoute('GET', 'userstory', '/userstory', 'UserStoryController@index');
        $this->router->addRoute('GET', 'personna', '/personna', 'PersonnaController@index');
        $this->router->addRoute('GET', 'download', '/download', 'DownloadController@index');
        $this->router->addRoute('GET', 'projects_show', '/myprojects', 'ProjectController@index');
        $route = $this->router->match($path, $request->getMethod());
        $route->execute();
    }
}
