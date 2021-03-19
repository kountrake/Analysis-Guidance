<?php


namespace Tests\Project;
use Project\Item\Personna;
use PHPUnit\Framework\TestCase;

class PersonnaTest extends TestCase
{

    private $personna;

    protected function setUp(): void
    {
        $this->personna = new Personna(
            2,
            "GIBBS",
            "Edouard",
            22,
            "étudiant",
            "connait plutôt la théorie de l'analyse fonctionnelle, trouver parfois le travail répétitif",
            "trouver un moyen d'assurer la cohérence inter-axe, pouvoir pré-mâcher son travail sur certains axes grâce à d'autres",
            "sc");

    }

    public function testGetId()
    {
        $this->assertEquals(2, $this->personna->getId());
    }

    public function testGetNom()
    {
        $this->assertEquals("GIBBS", $this->personna->getNom());
    }

    public function testGetPrenom()
    {
        $this->assertEquals("Edouard", $this->personna->getPrenom());
    }

    public function testGetAge()
    {
        $this->assertEquals( 22, $this->personna->getAge());
    }

    public function testGetRole()
    {
        $this->assertEquals("étudiant", $this->personna->getRole());
    }
    public function testGetCaracteristique()
    {
        $this->assertEquals("connait plutôt la théorie de l'analyse fonctionnelle, trouver parfois le travail répétitif", $this->personna->getCaracteristique());
    }
    public function tesGetObjectif()
    {
        $this->assertEquals("trouver un moyen d'assurer la cohérence inter-axe, pouvoir pré-mâcher son travail sur certains axes grâce à d'autres", $this->personna->getObjectif());
    }
    public function testGetScenario()
    {
        $this->assertEquals("test test test", $this->personna->getScenario());
    }

    
}
