<?php


namespace Project\Middleware;

use DateTime;
use DateTimeZone;
use Project\Db\Db;

class ProjectMiddleware
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
     * @param string $userId
     * @return array l'ensemble des projets de cet id
     * @throws ProjectMiddlewareException
     */
    public function getAllProjects(string $userId): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM projet WHERE userid=:userId');
        $values = array(':userId' => $userId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * @param string $projectId
     * @param string $userId
     * @return mixed un objet contenant l'ensemble du projet
     * @throws ProjectMiddlewareException
     */
    public function getProject(string $projectId, string $userId)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM projet WHERE idprojet=:projectId AND userid=:userId');
        $values = array(':projectId' => $projectId, ':userId' => $userId);
        $stmt->execute($values);
        $value = $stmt->fetch();
        if (!$value) {
            throw new ProjectMiddlewareException("Ce projet n'existe pas.");
        }
        return $value;
    }
    
    /**
     * @param string $userId
     * @return mixed le projet qui vient d'être créé
     */
    public function create(string $userId)
    {
        $date = new DateTime('now');
        $date->setTimezone(new DateTimeZone('Europe/Paris'));
        $stmt = $this->db->getPDO()->prepare('INSERT INTO projet (userid, date_creation, date_sauvegarde)
                                                    VALUES (:userId, :created_at, :modified_at)');

        $values = array(':userId' => $userId, ':created_at' => $date->format('c'),
            ':modified_at' => $date->format('c'));
        $stmt->execute($values);
        return $this->getLastProjectId($userId);
    }

    /**
     * @param string $projectId
     */
    public function delete(string $projectId)
    {
        $stmt = $this->db->getPDO()->prepare('DELETE FROM projet WHERE idprojet=:id');
        $values = array(':id' => $projectId);
        $stmt->execute($values);
    }

    /**
     * @param string $userId
     * @return int id du dernier projet
     */
    public function getLastProjectId(string $userId): int
    {
        $stmt = $this->db->getPDO()->prepare('SELECT MAX(idprojet) FROM projet WHERE userid=:userId');
        $values = array(':userId' => $userId);
        $stmt->execute($values);
        return $stmt->fetch()->max;
    }

    /**
     * @param string $userId
     * @param string $idprojet
     * @return array contient un projet
     */
    public function getoneProject(string $userId,string $idprojet): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM projet WHERE userid=:userId and idprojet=:idprojet');
        $values = array(':userId' => $userId,':idprojet' => $idprojet);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * @param float $Score_Moyen_Personna
     * @param string $projectId
     */
    public function update_score_persona(float $Score_Moyen_Personna,string $projectId)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE projet 
                SET Score_Moyen_Personna = :Score_Moyen_Personna
                WHERE IdProjet= :IdProjet');
        $values = array(':Score_Moyen_Personna' => $Score_Moyen_Personna, ':IdProjet' => $projectId);
        $stmt->execute($values);
    }

    /**
     * @param float $Score_Moyen_UserStory
     * @param string $projectId
     */
    public function update_score_moyUS(float $Score_Moyen_UserStory,string $projectId)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE projet 
                SET Score_Moyen_UserStory = :Score_Moyen_UserStory
                WHERE IdProjet= :IdProjet');
        $values = array(':Score_Moyen_UserStory' => $Score_Moyen_UserStory, ':IdProjet' => $projectId);
        $stmt->execute($values);
    }
    
    /**
     * @param float $Score_StoryMap
     * @param string $projectId
     */
    public function update_score_sm(float $Score_StoryMap,string $projectId)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE projet 
                SET Score_StoryMap = :Score_StoryMap
                WHERE IdProjet= :IdProjet');
        $values = array(':Score_StoryMap' => $Score_StoryMap, ':IdProjet' => $projectId);
        $stmt->execute($values);
    }

    /**
     * @param float $Score_matrice
     * @param string $projectId
     */
    public function update_score_matrice(float $Score_matrice,string $projectId)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE projet 
                SET Score_Matrice = :Score_Matrice
                WHERE IdProjet= :IdProjet');
        $values = array(':Score_Matrice' => $Score_matrice, ':IdProjet' => $projectId);
        $stmt->execute($values);
    }

    /**
     * @param float $score
     * @param string $projectId
     */
    public function update_score(float $score,string $projectId)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE projet
                SET score = :score
                WHERE IdProjet= :IdProjet');
        $values = array(':score' => $score, ':IdProjet' => $projectId);
        $stmt->execute($values);
    }
    
}
