<?php


namespace Project\Controller;

use GuzzleHttp\Psr7\Response;

class StoryMapController extends Controller
{
    public function index()
    {
        $this->viewcontrol('storymap');
    }
}
