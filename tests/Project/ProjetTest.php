<?php


namespace Tests\Project;
use Project\Item\Project;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{

    private $project;

    protected function setUp(): void
    {
        $this->project = new Project(
            1,
            date_create_immutable("2021-03-20 17:45:12"),
        );
    }

    public function testGetUserId()
    {
        $this->assertEquals(1, $this->project->getUserId());
    }

    
    public function testGetRegisteredAt()
    {
        $this->assertEquals("2012-03-24 17:45:12", $this->project->getRegisteredAt());
    }
}
