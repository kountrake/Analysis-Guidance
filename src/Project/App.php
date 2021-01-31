<?php

namespace Project;

use GuzzleHttp\Psr7\Response;
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
    private $modules;

    private $router;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->modules = [];
        $this->router = new Router();
        foreach ($this->modules as $module) {
            $temp = new $module($this->router);
            $temp->mapRoutes();
        }
    }


    /**
     * @param ServerRequestInterface $request
     * @return \GuzzleHttp\Psr7\MessageTrait|Response
     */
    public function run(ServerRequestInterface $request)
    {
        $uri = $request->getUri()->getPath();
        $tmpUri = str_replace('/~naessens', '', $uri);
        if (!empty($tmpUri) && strlen($tmpUri) > 1 && $tmpUri[-1] === "/") {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        }



        return new Response(404, [], '<h1 style="color: #ff0000">Erreur 404, Page introuvable </h1>');
    }
}
