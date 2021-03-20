<?php


namespace Tests\Project;
use Project\Item\UserStory;
use PHPUnit\Framework\TestCase;

class UserStoryTest extends TestCase
{

    private $userStory;

    protected function setUp(): void
    {
        $this->userStory = new UserStory(
            0,
            "Etudiant en Licence 3 Miage",
            "m'inscrire sur la liste",
            "je puisse utiliser les fonctionnalitées de lanalysis Guidance",
            "je suis alerté s'il y'a un problème d'information lors de l'inscription",
            "Mon compte est sécurisé",
            "Le processus est facile",
            date_create_immutable("2012-03-24 17:45:12")
        );
    }

    public function testGetId()
    {
        $this->assertEquals(0, $this->userStory->getId());
    }

    public function testGetEntantque()
    {
        $this->assertEquals("Etudiant en Licence 3 Miage", $this->userStory->getEntantque());
    }

    public function testGetJeuveux()
    {
        $this->assertEquals("m'inscrire sur la liste", $this->userStory->getJeuveux()());
    }

    public function testGetDesorte()
    {
        $this->assertEquals("je puisse utiliser les fonctionnalitées de lanalysis Guidance", $this->userStory->getDesorte());
    }

    public function testGetCritere1()
    {
        $this->assertEquals("je suis alerté s'il y'a un problème d'information lors de l'inscription", $this->userStory->getCritere1());
    }
    public function testGetCritere2()
    {
        $this->assertEquals("Mon compte est sécurisé", $this->userStory->getCritere2());
    }
    public function testGetCritere3()
    {
        $this->assertEquals("Le processus est facile", $this->userStory->getCritere3());
    }

    public function testGetRegisteredAt()
    {
        $this->assertEquals("2012-03-24 17:45:12", $this->userStory->getRegisteredAt());
    }
}
