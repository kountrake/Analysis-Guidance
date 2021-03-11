<?php


namespace Project\Item;

class Persona
{
    private $role;
    private $name;
    private $age;
    private $mark;

    /**
     * Persona constructor.
     * @param string $role
     * @param string $name
     * @param string $age
     * @param int $mark
     */
    public function __construct(string $role, string $name, string $age, int $mark)
    {
        $this->role = $role;
        $this->name = $name;
        $this->age = $age;
        $this->mark = $mark;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAge(): string
    {
        return $this->age;
    }

    /**
     * @return int
     */
    public function getMark(): int
    {
        return $this->mark;
    }
}
