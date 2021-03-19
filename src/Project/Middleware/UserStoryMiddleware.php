<?php


namespace Project\Middleware;

use Project\Db\Db;

class UserStoryMiddleware
{

    private $db;
    private $projectId;

    /**
     * PersonnaMiddleware constructor.
     * @param int $projectId
     */
    public function __construct(int $projectId)
    {
        $this->db = new Db();
        $this->projectId = $projectId;
    }

    public function getAllUserStories(): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM userstory WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    public function getUserStory(int $userStoryId)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM userstory 
                                                    WHERE idprojet=:projectId AND idus=:userStoryId');
        $values = array(':projectId' => $this->projectId, ':userStoryId' => $userStoryId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    public function getLastUserStory()
    {
        $stmt = $this->db->getPDO()->prepare('SELECT MAX(idus) FROM userstory WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    public function create(
        $entantque,
        $jeveux,
        $desorte,
        $critere1,
        $critere2,
        $critere3
    )
    {
        $stmt = $this->db->getPDO()->prepare(
            'INSERT INTO userstory (entantque, jeveux, desorte, critere1, critere2, critere3, idprojet)
                   VALUES (:entantque, :jeveux, :desorte, :critere1, :critere2, :critere3, :idprojet)'
        );
        $values = array(':entantque' => $entantque, ':jeveux' => $jeveux, ':desorte' => $desorte,
            ':critere1' => $critere1, ':critere2' => $critere2, ':critere3' => $critere3,
            ':idprojet' => $this->projectId);
        $stmt->execute($values);
    }

    public function update(
        $entantque,
        $jeveux,
        $desorte,
        $critere1,
        $critere2,
        $critere3,
        $idUs
    )
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE userstory 
                SET entantque = :entantque, jeveux = :jeveux, desorte = :desorte,
                    critere1 = :critere1, critere2 = :critere2, critere3 = :critere3 
                WHERE idus= :id');
        $values = array(':entantque' => $entantque, ':jeveux' => $jeveux, ':desorte' => $desorte,
            ':critere1' => $critere1, ':critere2' => $critere2,':critere3' => $critere3, ':id' => $idUs);
        $stmt->execute($values);
    }

    public function delete($id)
    {
        $stmt = $this->db->getPDO()->prepare('DELETE FROM userstory WHERE idus=:id');
        $values = array(':id' => $id);
        $stmt->execute($values);
    }
}
