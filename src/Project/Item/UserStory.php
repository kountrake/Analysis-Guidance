<?php


namespace Project\Item;

class UserStory
{
    private $role;
    private $want;
    private $for;
    private $satisfactions;

    /**
     * UserStory constructor.
     * @param $role
     * @param $want
     * @param $for
     * @param $satisfactions
     */
    public function __construct(string $role, string $want, string $for, array $satisfactions)
    {
        $this->role = $role;
        $this->want = $want;
        $this->for = $for;
        $this->satisfactions = $satisfactions;
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
    public function getWant(): string
    {
        return $this->want;
    }

    /**
     * @return string
     */
    public function getFor(): string
    {
        return $this->for;
    }

    /**
     * @return array
     */
    public function getSatisfactions(): array
    {
        return $this->satisfactions;
    }
}
