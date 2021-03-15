<?php


namespace Project\Middleware;


use Project\Db\Db;

class PersonnaMiddleware
{
    private $db;
    private $projectId;

    /**
     * PersonnaMiddleware constructor.
     */
    public function __construct(int $projectId)
    {
        $this->db = new Db();
        $this->projectId = $projectId;
    }

    public function getAllPersonnas(): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM personna WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    public function getPersonna(int $personnaId)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM personna 
                                                    WHERE idprojet=:projectId AND idpersonna=:personnaId');
        $values = array(':projectId' => $this->projectId, ':personnaId' => $personnaId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    public function getLastPersonna()
    {
        $stmt = $this->db->getPDO()->prepare('SELECT MAX(idpersonna) FROM personna WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

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

    public function update($name, $firstname, $age, $role, $caracteristique, $objectifs, $scenario, $idPersonna)
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

    public function delete($id)
    {
        $stmt = $this->db->getPDO()->prepare('DELETE FROM personna WHERE idpersonna=:id');
        $values = array(':id' => $id);
        $stmt->execute($values);
    }
}
