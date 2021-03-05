<?php


namespace Project\Controller;

use GuzzleHttp\Psr7\Response;

class UserStoryController extends Controller
{
    public function index()
    {
        $this->viewcontrol('userstory');
    }
}
