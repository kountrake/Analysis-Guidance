<?php


namespace Tests\Project;
use Project\Item\StorymapColumn;
use PHPUnit\Framework\TestCase;

class StorymapColumnTest extends TestCase
{
    private $storymapColumn;

    protected function setUp(): void
    {
        $this->storymapColumn = new StorymapColumn(
            "utilisateurs, gestionnaires",
            "visualise commandes, valide commande, envoie les commandes",
            "affiche liste utilisateurs, gère liste utilisateur"
        );
    }

    public function testGetRole()
    {
        $this->assertEquals("utilisateurs, gestionnaires", $this->storymapColumn->getRole());
    }


    public function testGetActivites()
    {
        $this->assertEquals("visualise commandes, valide commande, envoie les commandes", $this->storymapColumn->getActivites());
    }

    public function testGetStrories()
    {
        $this->assertEquals("affiche liste utilisateurs, gère liste utilisateur", $this->storymapColumn->getStories());
    }
}

   