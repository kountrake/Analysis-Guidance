<?php


namespace Project\Middleware;

use Project\Db\Db;
use Project\Item\User;

class UserMiddleware

/**  */

    private $db;

    /**
     * UserMiddleware constructor.
     */
    public function __construct()
    {
        $this->db = new Db();
    }

    /**
     * $email et $password sont des paramètres de la fonction  login() déja enregistrer dans la base qui permettent de s'identifier   
     * @param string $email adresse email pour se connecter
     * @param string $password mot de passe pour se connecter
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
    * differents paramètres qui permettent l'enregistrement des infoprmations de l'utilisateur
     * @param string $lastname nom de l'utilisateur inscrit dans la base
     * @param string $firstname prénom de l'utilisateur inscrit dans la base
     * @param string $email adresse email de l'utilisateur inscrit dans la base
     * @param string $password mot de passe de l'utilisateur inscrit dans la base
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
     * paramètre permettant à partir de la fonction updateInfo de modifier des information de l'utilisateur
     * @param string $lastname nom de l'utilisateur 
     * @param string $firstname prénom de l'utilisateur
     * @param string $email adresse email de l'utilisateur
     * @param int $id identification de l'utilisateur
     */
    public function updateInfo(string $lastname, string $firstname, string $email, int $id)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE utilisateur SET prenom= :prenom, nom= :nom, mail= :mail 
WHERE userid= :id');
        $values = array(':prenom' => $firstname,':nom' => $lastname, ':mail' => $email, 'id' => $id);
        $stmt->execute($values);
    }

    /**
     * paramètre permettant la modification de l'actuel mot de passe suite à un changement ou à un oubli
     * @param string $previous ancien mot de passe enregistré dans la base de donnée
     * @param string $new nouveau mot de passe enregistré dans la base de donnée
     * @param string $confirm la confirmation du mot de passe saisi
     * @param int $id identification  de l'utilisateur
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
/**
 * param $id dans la fonction deleteAccount() permet la suppression du compte
 * @param int $id  identification  de  l'utilisateur
 */
    public function deleteAccount($id)
    {
        $stmt = $this->db->getPDO()->prepare('DELETE FROM utilisateur WHERE userid=:id');
        $values = array(':id' => $id);
        $stmt->execute($values);
    }

    public function userstory(string $entanque, string $jeveux, string $desorte, string $satisfait)
    {
        $stmt = $this->db->getPDO()->prepare('INSERT INTO userstory VALUES (:entantque, :jeveux, :desorte,
                              :satisfait)');
        $values = array(':entanque' => $entanque, ':jeveux' => $jeveux, ':desorte' => $desorte, ':satisfait' => $satisfait);
        $stmt->execute($values);
    }
}
