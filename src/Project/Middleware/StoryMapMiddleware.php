<?php


namespace Project\Middleware;

use Project\Db\Db;
use Project\Item\StorymapColumn;

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

    public function createStory(string $story, int $priorite, int $idactivite)
    {
            $stmt = $this->db->getPDO()->prepare(
                'INSERT INTO story (description, priorité, idactivite)
                       VALUES (:story, :priorite, :idactivite)'
            );
            $values = array(':story' => $story,':priorite' => $priorite, ':idactivite' => $idactivite);
            $stmt->execute($values);
    }

    public function delete()
    {
        $stmt = $this->db->getPDO()->prepare('DELETE FROM storymap WHERE idprojet=:id');
        $values = array(':id' => $this->projectId);
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

    public function getAllStories(int $idactivite): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM story 
                                                    WHERE idactivite=:idactivite
                                                    ORDER BY priorité DESC');
        $values = array(':idactivite' => $idactivite);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    public function activitiesFromRoles($roles): array
    {
        $activities = [];
        foreach ($roles as $role) {
            $activities[] = $this->getAllActivites($role->idbut);
        }
        return $activities;
    }

    public function storiesFromActivities($activities): array
    {
        $stories = [];
        foreach ($activities as $activity) {
            foreach ($activity as $a) {
                $stories[] = $this->getAllStories($a->idactivite);
            }
        }
        return $stories;
    }

    /**
     * @param array $roles
     * @param array $activites
     * @param array $stories
     * @return array
     */
    public function createColumns(array $roles, array $activites, array $stories): array
    {
        $columns = [];
        $i = 0;
        $j = 0;
        foreach ($roles as $role) {
            $tmp = [];
            foreach ($activites[$i] as $activite) {
                for ($cpt = 0; $cpt < 3; $cpt++) {
                    $tmp[] = $stories[$j][$cpt];
                }
                $j++;
            }
            $columns[] = new StorymapColumn($role, $activites[$i], $tmp);
            $i++;
        }
        return $columns;
    }
}
