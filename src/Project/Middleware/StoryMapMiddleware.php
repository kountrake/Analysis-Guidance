<?php


namespace Project\Middleware;

use Project\Db\Db;
use Project\Item\StorymapColumn;

class StoryMapMiddleware
{
    private Db $db;
    private int $projectId;

    /**
     * StoryMapMiddleware constructor.
     * @param int $projectId
     */
    public function __construct(int $projectId)
    {
        $this->db = new Db();
        $this->projectId = $projectId;
    }


    /**
     * Retourne toutes les userStory comprises dans la table userstory
     * @return array
     */
    public function getAllUserStories(): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM userstory WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * Return une simple userStory comprise dans la table userstory
     * @param string $userStoryId
     * @return mixed
     */
    public function getUserStory(string $userStoryId): mixed
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM userstory
                                                    WHERE idprojet=:projectId AND idus=:userStoryId');
        $values = array(':projectId' => $this->projectId, ':userStoryId' => $userStoryId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    /**
     * Crée un role dans la table storymap
     * @param string $role
     */
    public function createRole(string $role)
    {
        $stmt = $this->db->getPDO()->prepare(
            'INSERT INTO storymap (role,idprojet)
                   VALUES (:role,:idprojet)'
        );
        $values = array(':role' => $role,':idprojet' => $this->projectId);
        $stmt->execute($values);
    }

    /**
     * Crée une activité à lier à une Storymap dans la table flotnarattion
     * @param string $activite
     * @param string $idbut
     */
    public function createActivite(string $activite, string $idbut)
    {
        $stmt = $this->db->getPDO()->prepare(
            'INSERT INTO flotnarattion (activite,idbut)
                   VALUES (:activite,:idbut)'
        );
        $values = array(':activite' => $activite,':idbut' => $idbut);
        $stmt->execute($values);
    }

    /**
     * Crée une story à lier à une activité dans la table story
     * @param string $story
     * @param int $priorite
     * @param string $idactivite
     */
    public function createStory(string $story, int $priorite, string $idactivite)
    {
            $stmt = $this->db->getPDO()->prepare(
                'INSERT INTO story (description, priorité, idactivite)
                       VALUES (:story, :priorite, :idactivite)'
            );
            $values = array(':story' => $story,':priorite' => $priorite, ':idactivite' => $idactivite);
            $stmt->execute($values);
    }

    /**
     * Supprime le projet de la table Storymap et de toutes celles liées
     */
    public function delete()
    {
        $stmt = $this->db->getPDO()->prepare('DELETE FROM storymap WHERE idprojet=:id');
        $values = array(':id' => $this->projectId);
        $stmt->execute($values);
    }

    /**
     * Retourne le dernier role crée d'un projet
     * @return mixed
     */
    public function getLastRoleId()
    {
        $stmt = $this->db->getPDO()->prepare('SELECT MAX(idbut) FROM storymap WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    /**
     * Retourne tout les roles crées dans un projet
     * @return array
     */
    public function getAllRoles(): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM storymap 
                                                    WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * Retourne toutes les activités d'une storymap
     * @param string $idbut
     * @return array
     */
    public function getAllActivites(string $idbut): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM flotnarattion 
                                                    WHERE idbut=:idbut');
        $values = array(':idbut' => $idbut);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * Retourne toutes les story liées à une activité
     * @param string $idactivite
     * @return array
     */
    public function getAllStories(string $idactivite): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM story 
                                                    WHERE idactivite=:idactivite
                                                    ORDER BY priorité DESC');
        $values = array(':idactivite' => $idactivite);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * Retourne le nombre de story d'une activité
     * @param string $idactivite
     * @return mixed
     */
    public function getNumberStories(string $idactivite)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT Count(*) as cou FROM story NATURAL JOIN FlotNarattion NATURAL JOIN StoryMap                                                    
                                                    WHERE StoryMap.idprojet=:idactivite');
        $values = array(':idactivite' => $idactivite);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    /**
     * Retourne toutes les activités de chaque role en paramètre
     * @param $roles
     * @return array
     */
    public function activitiesFromRoles($roles): array
    {
        $activities = [];
        foreach ($roles as $role) {
            $activities[] = $this->getAllActivites($role->idbut);
        }
        return $activities;
    }

    /**
     * Retourne toutes les story de chaque activité en paramètre
     * @param $activities
     * @return array
     */
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
     *  Retourne une colonne de la storymap
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
