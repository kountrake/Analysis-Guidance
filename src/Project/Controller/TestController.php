<?php

//TODO Cette classe est à supprimer avant le rendu du projet

namespace Project\Controller;

use \Exception;
use Project\Item\StorymapColumn;
use Project\Middleware\ProjectMiddleware;
use Project\Middleware\ProjectMiddlewareException;
use Project\Middleware\StoryMapMiddleware;
use Project\Middleware\UserStoryMiddleware;

class TestController extends Controller
{
    public function test(string $projectId)
    {
        session_start();
        try {
            $pm = new ProjectMiddleware();
            $pm->getProject($projectId, $_SESSION['user']->getId());
            $usmid = new UserStoryMiddleware($projectId);
            $us = $usmid->getUserStory(35);
            echo '<pre>';
            var_dump($us);
            echo '</pre>';
            die();
        } catch (ProjectMiddlewareException $e) {
            echo '<pre>';
            var_dump($e->getMessage());
            echo '</pre>';
        }
    }
}
