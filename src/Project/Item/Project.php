<?php


namespace Project\Item;

class Project
{
    private $userId;
   

    /**
     * 
     */
    public function __construct()
    {
        
    
    }
    
     /**
     * @return integer
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param integer $userId;
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

 
}
