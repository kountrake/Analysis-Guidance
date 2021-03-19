<?php


namespace Tests\Project;
use Project\Item\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    private $user;

    protected function setUp(): void
    {
        $this->user = new User(
            0,
            "John",
            "Doe",
            "email@email.fr",
            "motdepassehash",
            date_create_immutable("2012-03-24 17:45:12")
        );
    }

    public function testGetId()
    {
        $this->assertEquals(0, $this->user->getId());
    }

    public function testGetFirstname()
    {
        $this->assertEquals("John", $this->user->getFirstname());
    }

    public function testGetLastname()
    {
        $this->assertEquals("Doe", $this->user->getLastname());
    }

    public function testGetEmail()
    {
        $this->assertEquals("email@email.fr", $this->user->getEmail());
    }

    public function testGetPassword()
    {
        $this->assertEquals("motdepassehash", $this->user->getPassword());
    }

    public function testGetRegisteredAt()
    {
        $this->assertEquals("2012-03-24 17:45:12", $this->user->getRegisteredAt());
    }
}
