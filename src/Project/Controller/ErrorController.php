<?php


namespace Project\Controller;


class ErrorController extends Controller
{
    public function doesNotExist()
    {
        $this->view('error.404');
    }
}
