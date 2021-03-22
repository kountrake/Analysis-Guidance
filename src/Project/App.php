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
        $this->router = new Router();
    }


    /**
     * @param ServerRequestInterface $request
     */
    public function run(ServerRequestInterface $request)
    {
        $path = str_replace('/~naessens', '', $request->getUri()->getPath());

        /*
         * La route de la page d'accueil
         */
        $this->router->addRoute('GET', 'home', '/', 'HomeController@index');

        /*
         * Les routes de la page profil
         */
        $this->router->addRoute('GET', 'dashboard_index', '/dashboard', 'DashboardController@index');
        $this->router->addRoute('POST', 'dashboard_password', '/dashboard/update/password', 'DashboardController@updatePassword');
        $this->router->addRoute('POST', 'dashboard_info', '/dashboard/update/info', 'DashboardController@updateInfo');
        $this->router->addRoute('POST', 'dashboard_delete', '/dashboard/delete/account', 'DashboardController@delete');

        /*
         * La route de la page d'aide
         */
        $this->router->addRoute('GET', 'help_index', '/help', 'HelpController@index');

        /*
         * Les routes de la page connexion
         */
        $this->router->addRoute('GET', 'login', '/login', 'LoginController@index');
        $this->router->addRoute('POST', 'login_connexion', '/login', 'LoginController@login');
        $this->router->addRoute('POST', 'login_logout', '/logout', 'LoginController@logout');

        /*
         * Les routes de l'inscription
         */
        $this->router->addRoute('GET', 'register', '/register', 'RegisterController@index');
        $this->router->addRoute('POST', 'register_post', '/register', 'RegisterController@register');

        /*
         * La route de la page score
         */
        $this->router->addRoute('GET', 'score', '/score/:id', 'ScoreController@index');

        /*
         * Les routes de la page User Story
         */
        $this->router->addRoute('GET', 'userstory_index', '/userstory/:id', 'UserStoryController@index');
        $this->router->addRoute('POST', 'userstory_add', '/userstory/add/:id', 'UserStoryController@create');
        $this->router->addRoute('POST', 'userstory_change', '/userstory/change', 'UserStoryController@change');
        $this->router->addRoute('POST', 'userstory_update', '/userstory/update', 'UserStoryController@update');
        $this->router->addRoute('POST', 'userstory_delete', '/delete/userstory', 'UserStoryController@delete');

        /*
         * Les routes de la page Personna
         */
        $this->router->addRoute('GET', 'personna_index', '/personna/:id', 'PersonnaController@index');
        $this->router->addRoute('POST', 'personna_add', '/personna/add/:id', 'PersonnaController@create');
        $this->router->addRoute('POST', 'personna_change', '/personna/change', 'PersonnaController@change');
        $this->router->addRoute('POST', 'personna_update', '/personna/update', 'PersonnaController@update');
        $this->router->addRoute('POST', 'personna_delete', '/delete/personna', 'PersonnaController@delete');

        /*
         * Les routes de la page Matrice
         */
        $this->router->addRoute('GET', 'matrice_index', '/matrice/:id', 'MatriceController@index');

        /*
         * Les routes pour le téléchargement
         */
        $this->router->addRoute('GET', 'download', '/download/:id', 'DownloadController@index');
        $this->router->addRoute('GET', 'download_personna', '/download/personna/:id', 'DownloadController@gethtmlPersonna');
        $this->router->addRoute('GET', 'download_userstory', '/download/userstory/:id', 'DownloadController@gethtmlUserStory');
        $this->router->addRoute('GET', 'download_storymap', '/download/storymap/:id', 'DownloadController@gethtmlStoryMap');
        $this->router->addRoute('GET', 'download_project', '/download/project/:id', 'DownloadController@gethtmlProject');

        /*
         * Les routes pour la gestions des projets
         */
        $this->router->addRoute('GET', 'projects_show', '/myprojects', 'ProjectController@index');
        $this->router->addRoute('POST', 'project_delete', '/myprojects/delete/project', 'ProjectController@delete');
        $this->router->addRoute('GET', 'project_show', '/myprojects/:id', 'ProjectController@show');
        $this->router->addRoute('GET', 'project_create', '/project/create', 'ProjectController@create');

        /*
         * Les routes pour la Story Map
         */
        $this->router->addRoute('GET', 'storymap', '/storymap/:id', 'StoryMapController@index');
        $this->router->addRoute('GET', 'storymap_role', '/storymap/role/:id', 'StoryMapController@role');
        $this->router->addRoute('POST', 'storymap_role_create', '/storymap/role/create', 'StoryMapController@createRole');
        $this->router->addRoute('GET', 'storymap_activite', '/storymap/activite/:id', 'StoryMapController@activite');
        $this->router->addRoute('POST', 'storymap_activite_create', '/storymap/activite/create', 'StoryMapController@createActivite');
        $this->router->addRoute('POST', 'storymap_delete', '/storymap/delete', 'StoryMapController@delete');

        $route = $this->router->match($path, $request->getMethod());
        $route->execute();
    }
}
