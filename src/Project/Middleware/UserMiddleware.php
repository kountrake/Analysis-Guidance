<?php


namespace Project\Middleware;

use Project\Db\Db;

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
     * @return mixed|null
     */
    public function login(string $email, string $password)
    {
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $user = $this->db->query('SELECT * FROM utilisateur WHERE mail='. $email);
        if (count($user) === 1 &&
            filter_var($email, FILTER_VALIDATE_EMAIL) &&
            password_verify($password, $user[0]->mdp)) {
            return $user[0];
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
        $query = 'INSERT INTO utilisateur VALUES (prenom ='. $firstname.', nom = '.$lastname.', mail = '.$email.
            ', mdp = ' .$hash.')';
        $this->db->query($query);
    }
}
