<?php

use GuzzleHttp\Psr7\ServerRequest;
use Project\App;
use function Http\Response\send;

require "../vendor/autoload.php";

$app = new App();

$response = $app->run(ServerRequest::fromGlobals());
send($response);
