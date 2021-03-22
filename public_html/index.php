<?php

use GuzzleHttp\Psr7\ServerRequest;
use Project\App;

require "../vendor/autoload.php";

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR);

$app = new App();

$app->run(ServerRequest::fromGlobals());
