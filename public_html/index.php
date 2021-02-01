<?php

use GuzzleHttp\Psr7\ServerRequest;
use Project\App;
use function Http\Response\send;

require "../vendor/autoload.php";

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR);
define('CSS', dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR );
define('JS', dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "js" . DIRECTORY_SEPARATOR );

$app = new App();

$app->run(ServerRequest::fromGlobals());
