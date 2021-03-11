<?php


namespace Project\Item;

class StoryMap
{
    private $role;
    private $mark;

    /**
     * StoryMap constructor.
     * @param $role
     * @param $mark
     */
    public function __construct(string $role, int $mark)
    {
        $this->role = $role;
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
     * @return int
     */
    public function getMark(): int
    {
        return $this->mark;
    }
}
