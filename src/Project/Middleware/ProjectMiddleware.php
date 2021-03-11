<?php


namespace Project\Middleware;

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
}
