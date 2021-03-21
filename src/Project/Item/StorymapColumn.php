<?php


namespace Project\Item;

class StorymapColumn
{

    public $role;
    public $activites;
    public $stories;

    /**
     * StorymapColumn constructor.
     * @param $role
     * @param $activites
     * @param $stories
     */
    public function __construct($role, $activites, $stories)
    {
        $this->role = $role;
        $this->activites = $activites;
        $this->stories = $stories;
    }
    /**
     * @return array
     */
    public function getRole(): array
    {
        return $this->role;
    }
    /**
     * @return array
     */
    public function getActivites(): array
    {
        return $this->activites;
    }
    /**
     * @return array
     * 
    */
    
    public function getStories(): array
    {
        return $this->stories;
    }
}

