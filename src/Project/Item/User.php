<?php


namespace Project\Item;

class User
{

    private $firstname;
    private $lastname;
    private $email;
    private $id;

    /**
     * User constructor.
     * @param $prenom
     * @param $nom
     * @param $mail
     */
    public function __construct($prenom, $nom, $mail)
    {
        $this->firstname = $prenom;
        $this->lastname = $nom;
        $this->email = $mail;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return integer
     */
    public function getId()
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
