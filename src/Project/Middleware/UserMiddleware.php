<?php


namespace Project\Middleware;

use Project\Db\Db;
use Project\Item\User;

class UserMiddleware
{

    private $db;

    /**
     * UserMiddleware constructor.
     */
    public function __construct()
    {
        $this->db = new Db();
    }

    /**
     * @param string $email
     * @param string $password
     * @return User|null
     */
    public function login(string $email, string $password)
    {
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM utilisateur WHERE mail=:mail');
        $values = array(':mail' => $email);
        $stmt->execute($values);
        $userDB = $stmt->fetch();
        if ($userDB &&
            filter_var($email, FILTER_VALIDATE_EMAIL) &&
            password_verify($password, $userDB->mdp)) {
            $user = new User(
                $userDB->prenom,
                $userDB->nom,
                $userDB->mail
            );
            $user->setId($userDB->userid);
            return $user;
        }
        return null;
    }

    /**
     * @param string $lastname
     * @param string $firstname
     * @param string $email
     * @param string $password
     */
    public function register(string $lastname, string $firstname, string $email, string $password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->getPDO()->prepare('INSERT INTO utilisateur (prenom, nom, mail, mdp) VALUES (:prenom, 
                                                        :nom, :mail, :mdp)');
        $values = array(':prenom' => $firstname,':nom' => $lastname, ':mail' => $email, ':mdp' => $hash);
        $stmt->execute($values);
    }
}
