<?php


namespace Project\Middleware;


use Project\Db\Db;

class PersonnaMiddleware
{
    private $db;
    private $projectId;

    /**
     * PersonnaMiddleware constructor.
     * @param $projectId int L'id du projet auquel les personas seront attribués
     */
    public function __construct(int $projectId)
    {
        $this->db = new Db();
        $this->projectId = $projectId;
    }

    /**
     * Récuperer tout les Personas d'un projet
     * @return array les personas lié à un projet
     */
    public function getAllPersonnas(): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM personna WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * Récuperer un Persona d'un projet
     * @param $personnaId string l'id du persona recherché
     * @return mixed le persona recherché
     */
    public function getPersonna(string $personnaId)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM personna 
                                                    WHERE idprojet=:projectId AND idpersonna=:personnaId');
        $values = array(':projectId' => $this->projectId, ':personnaId' => $personnaId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    /**
     * Récuperer le dernier persona d'un projet
     * @return mixed le dernier persona lié à un projet
     */
    public function getLastPersonna()
    {
        $stmt = $this->db->getPDO()->prepare('SELECT MAX(idpersonna) FROM personna WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    /**
     * Récuperer le premier persona d'un projet
     * @return mixed le premier persona lié à un projet
     */
    public function getFirstPersonna()
    {
        $stmt = $this->db->getPDO()->prepare('SELECT MIN(idpersonna) FROM personna WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    /**
     * Parmètres de création d'un persona
     * @param $nom string
     * @param $prenom string
     * @param $age int
     * @param $role string
     * @param $caracteristique string
     * @param $objectif string
     * @param $scenario string
     */
    public function create(
        string $nom,
        string $prenom,
        int $age,
        string $role,
        string $caracteristique,
        string $objectif,
        string $scenario
    )
    {
        $stmt = $this->db->getPDO()->prepare(
            'INSERT INTO personna (nom, prenom, age, role, scénario, objectif, caractéristiques, idprojet)
                   VALUES (:nom, :prenom, :age, :role, :scenario, :objectif, :caracteristiques, :idprojet)'
        );
        $values = array(':nom' => $nom, ':prenom' => $prenom, ':age' => $age, ':role' => $role,
            ':scenario' => $scenario, ':objectif' => $objectif,
            ':caracteristiques' => $caracteristique, ':idprojet' => $this->projectId);
        $stmt->execute($values);
    }

    /**
     * Modifier un Persona
     * @param $name string
     * @param $firstname string
     * @param $age int
     * @param $role string
     * @param $caracteristique string
     * @param $objectifs string
     * @param $scenario string
     * @param $idPersonna string
     */
    public function update(string $name,string $firstname, int $age,string $role, string $caracteristique,string $objectifs,string $scenario,string $idPersonna)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE personna 
                SET nom = :nom, prenom = :prenom, age = :age, role = :role,
                    scénario = :scenario, objectif = :objectif, caractéristiques = :caracteristiques 
                WHERE idpersonna= :id');
        $values = array(':nom' => $name, ':prenom' => $firstname, ':age' => $age, ':role' => $role,
            ':scenario' => $scenario, ':objectif' => $objectifs,
            ':caracteristiques' => $caracteristique, ':id' => $idPersonna);
        $stmt->execute($values);
    }

    /**
     * Modifier le Score d'un persona
     * @param $id_p string l'id du persona
     * @param $score float nouvelle valeur du score d'un persona
     */
    public function update_score(string $id_p,$score)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE personna 
                SET Score_Persona = :Score_Persona
                WHERE idpersonna= :id');
        $values = array(':Score_Persona' => $score, ':id' => $id_p);
        $stmt->execute($values);
    }

    /**
     * Obtenir la moyenne d'un persona
     * @return array La moyenne de score des personas
     */
    public function getscore_moyen()
    {
        $stmt = $this->db->getPDO()->prepare('SELECT avg(Score_Persona) as sco FROM personna WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

     /**
     * Supprimer un persona
     * @param $id string Id du persona a supprimer
     */
    public function delete(string $id)
    {
        $stmt = $this->db->getPDO()->prepare('DELETE FROM personna WHERE idpersonna=:id');
        $values = array(':id' => $id);
        $stmt->execute($values);
    }

    /**
     * Retourne tout les roles des personas 
     * @return array Tout les roles des personas
     */
    public function getAllRoles(): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT role FROM personna WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }
}
