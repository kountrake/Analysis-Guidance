<?php


namespace Project\Middleware;

use Project\Db\Db;

class StoryMapMiddleware
{
    private $db;
    private $projectId;

    /**
     * StoryMapMiddleware constructor.
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

    public function getStoryMap(int $storymapId)
    {
        return 1;
    }

    public function createRole(string $role)
    {
        $stmt = $this->db->getPDO()->prepare(
            'INSERT INTO storymap (role,idprojet)
                   VALUES (:role,:idprojet)'
        );
        $values = array(':role' => $role,':idprojet' => $this->projectId);
        $stmt->execute($values);
    }

    public function createActivite(string $activite, int $idbut)
    {
        $stmt = $this->db->getPDO()->prepare(
            'INSERT INTO flotnarattion (activite,idbut)
                   VALUES (:activite,:idbut)'
        );
        $values = array(':activite' => $activite,':idbut' => $idbut);
        $stmt->execute($values);
    }


    public function createStory(
        string $story,
        int $priorite,
        int $idactivite
    ) {
            $stmt = $this->db->getPDO()->prepare(
                'INSERT INTO story (description, priorité, idactivite)
                       VALUES (:story, :priorite, :idactivite)'
            );
            $values = array(':story' => $story,':priorite' => $priorite, ':idactivite' => $idactivite);
            $stmt->execute($values);
    }

    public function updateRole($role, $idBut)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE storymap
                SET role = :role
                WHERE idbut= :id');
        $values = array(':role' => $role, ':id' => $idBut);
        $stmt->execute($values);
    }

    public function updateActivite($activite, $idactivite)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE flotnarattion
                SET activite = :activite
                WHERE idactivite= :id');
        $values = array(':activite' => $activite, ':id' => $idactivite);
        $stmt->execute($values);
    }

    public function updateStory($story, $priorite, $idstory)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE story
                SET description = :story, priorité = :priorite
                WHERE idstory= :id');
        $values = array(':story' => $story, ':id' => $idstory);
        $stmt->execute($values);
    }

    public function delete($id)
    {
        $stmt = $this->db->getPDO()->prepare('DELETE FROM storymap WHERE idbut=:id');
        $values = array(':id' => $id);
        $stmt->execute($values);
    }

    public function getLastRoleId()
    {
        $stmt = $this->db->getPDO()->prepare('SELECT MAX(idbut) FROM storymap WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    public function getAllRoles(): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM storymap 
                                                    WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    public function getAllActivites(int $idbut): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM flotnarattion 
                                                    WHERE idbut=:idbut');
        $values = array(':idbut' => $idbut);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }
}
