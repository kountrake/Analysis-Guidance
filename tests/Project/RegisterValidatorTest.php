<?php


namespace Tests\Project;

use PHPUnit\Framework\TestCase;
use Project\Validator\RegisterValidator;

class RegisterValidatorTest extends TestCase
{

    private $validator;

    public function setUp(): void
    {
        $this->validator = new RegisterValidator();
    }

    public function testIsValidName()
    {
        $this->assertTrue($this->validator->isValidName("John"));
        $this->assertTrue($this->validator->isValidName("Doe"));
    }

    public function testIsValidEmail()
    {
        $this->assertTrue($this->validator->isValidEmail("email@email.fr"));
        $this->assertFalse($this->validator->isValidEmail("email.email.fr"));
        $this->assertFalse($this->validator->isValidEmail("@email.fr"));
        $this->assertFalse($this->validator->isValidEmail("email@email"));
    }

    public function testIsValidPassword()
    {
        $this->assertTrue($this->validator->isValidPassword("JohnDoe123"));
        $this->assertFalse($this->validator->isValidPassword("JohnDoes"));
        $this->assertFalse($this->validator->isValidPassword("12345678"));
        $this->assertFalse($this->validator->isValidPassword("nomaj123"));
        $this->assertFalse($this->validator->isValidPassword("2Short"));
    }
}
