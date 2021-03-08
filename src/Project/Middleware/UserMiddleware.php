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

    /**
     * @param string $lastname
     * @param string $firstname
     * @param string $email
     * @param int $id
     */
    public function updateInfo(string $lastname, string $firstname, string $email, int $id)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE utilisateur SET prenom= :prenom, nom= :nom, mail= :mail 
WHERE userid= :id');
        $values = array(':prenom' => $firstname,':nom' => $lastname, ':mail' => $email, 'id' => $id);
        $stmt->execute($values);
    }

    /**
     * @param string $previous
     * @param string $new
     * @param string $confirm
     * @param int $id
     * @return bool
     */
    public function updatePassword(string $previous, string $new, string $confirm, int $id): bool
    {
        $password = htmlspecialchars($previous);
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM utilisateur WHERE userid=:id');
        $values = array(':id' => $id);
        $stmt->execute($values);
        $userDB = $stmt->fetch();
        if ($userDB && password_verify($password, $userDB->mdp) && $new === $confirm) {
            $stmt = $this->db->getPDO()->prepare('UPDATE utilisateur SET mdp= :new WHERE userid= :id');
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $values = array(':new' => $hash, ':id' => $id);
            $stmt->execute($values);
            return true;
        }
        return false;
    }

    public function deleteAccount($id)
    {
        $stmt = $this->db->getPDO()->prepare('DELETE FROM utilisateur WHERE userid=:id');
        $values = array(':id' => $id);
        $stmt->execute($values);
    }
 public function userstory(string $usname,string $entanque,string $jeveux,string $desorte,string $satisfait)
    {
        $stmt = $this->db->getPDO()->prepare('INSERT INTO userstory VALUES (:usname,
                                                :entantque, :jeveux, :desorte, :satisfait)');
        $values = array(':usname'=>$usname, ':entanque'=>$entanque, ':jeveux'=>$jeveux, ':desorte'=>$desorte,':satisfait'=>$satisfait);
        return $stmt->execute($values);
    }
}
