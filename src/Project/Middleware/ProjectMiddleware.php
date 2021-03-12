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

    public function getAllProjects(int $userId): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM projet WHERE userid=:userId');
        $values = array(':userId' => $userId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    public function getProject(int $projectId, int $userId)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM projet WHERE idprojet=:projectId AND userid=:userId');
        $values = array(':projectId' => $projectId, ':userId' => $userId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    public function create(int $userId)
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

    public function delete($projectId)
    {
        $stmt = $this->db->getPDO()->prepare('DELETE FROM projet WHERE idprojet=:id');
        $values = array(':id' => $projectId);
        $stmt->execute($values);
    }

    public function getLastProjectId($userId): int
    {
        $stmt = $this->db->getPDO()->prepare('SELECT MAX(idprojet) FROM projet WHERE userid=:userId');
        $values = array(':userId' => $userId);
        $stmt->execute($values);
        return $stmt->fetch();
    }
}
