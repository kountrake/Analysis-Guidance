<?php


namespace Tests\Projet;


use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Project\App;

class AppTest extends TestCase
{

    public function testRedirectionTrailingSlash(){
        $app = new App();
        $request = new ServerRequest('GET', '/test/');
        $response = $app->run($request);
        $this->assertContains('/test', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testHomePage(){
        $app = new App();
        $request = new ServerRequest('GET', '/home');
        $response = $app->run($request);
        $this->assertEquals('<h1>Bienvenue sur le projet</h1>', (string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testError404(){
        $app = new App();
        $request = new ServerRequest('GET', '/fnfezqfez');
        $response = $app->run($request);
        $this->assertEquals('<h1>Erreur 404, Page introuvable </h1>', (string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }

}