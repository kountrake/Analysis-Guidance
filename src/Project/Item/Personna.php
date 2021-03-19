<?php


namespace Project\Item;

class Personna
{
    private $nom;
        private $prenom;
        private $age;
        private $role;
        private $caracteristique;
        private $objectif;
        private $scenario;

   

    /**
     * Personna constructor.
     * @param $nom
     * @param $prenom
     * @param $role
     * @param $caracteristique
     * @param $objectif
     * @param $scenario
     * 
     */
    public function __construct($nom,$prenom, $age, $role,$caracteristique,$objectif, $scenario)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age= $age;
        $this->role = $role;
        $this->caracteristique = $caracteristique;
        $this->objectif = $objectif;
        $this->scenario = $scenario;
        


    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
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

    public function getCaracteristique(): string
    {
        return $this->caracteristique;
    }
    /**
     * @return string
     */

    public function getObjectif(): string
    {
        return $this->objectif;
    }

     /**
     * @return string
     */

    public function getScenario(): string
    {
        return $this->scenario;
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
