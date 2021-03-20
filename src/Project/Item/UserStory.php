<?php


namespace Project\Item;

class UserStory
{   private $id;
    private $entantque;
    private $jeveux;
    private $desorte;
    private $critere1;
    private $critere2;
    private $critere3;

    /**
     * UserStory constructor.
     * @param $entantque
     * @param $jeveux
     * @param $desorte
     * @param $critere1
     * @param $critere2
     * @param $critere3
     */
    public function __construct(string $entantque, string $jeveux, string $desorte, string $critere1,string $critere2,string $critere3)
    {
        $this->entantque =  $entantque;
        $this->jeveux = $jeveux;
        $this->desorte = $desorte;
        $this->critere1 = $critere1;
        $this->critere2 = $critere2;
        $this->critere3 = $critere3;

    }
    
    /**
     * @return string
     */
    public function getEntantque(): string
    {
        return $this->entantque;
    }

    /**
     * @return string
     */
    public function getJeuveux(): string
    {
        return $this->jeveux;
    }

    /**
     * @return string
     */
    public function getDesorte(): string
    {
        return $this->desorte;
    }

    /**
     * @return array
     */
    public function getCritere1(): string
    {
        return $this->critere1;
    }

    /**
     * @return array
     */
    public function getCritere2(): string
    {
        return $this->critere2;
    }

    /**
     * @return array
     */
    public function getCritere3(): string
    {
        return $this->critere3;
    }
    
     /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
