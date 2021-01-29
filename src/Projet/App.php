<?php

namespace Project;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class App
{
    public function run(ServerRequestInterface $request)
    {
        $uri = $request->getUri()->getPath();
        if (!empty($uri) && strlen($uri) > 1 && $uri[-1] === "/") {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        }

        if ($uri === '/' || $uri === "/home") {
            return new Response(200, [], '<h1>Bienvenue sur le projet</h1>');
        }

        return new Response(404, [], '<h1>Erreur 404, Page introuvable </h1>');
    }
}
