<?php


namespace Project\Db;

use \PDO;

class Db
{
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    /**
     * Db constructor.
     * @param $db_name
     * @param $db_user
     * @param $db_pass
     * @param $db_host
     */
    public function __construct(
        $db_name = 'naessens',
        $db_user = 'naessens',
        $db_pass = '80g6yydx8OPhgP5pfQIsaS9MEDvIkO97',
        $db_host = 'webtp.fil.univ-lille1.fr'
    ) {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    /**
     * @return PDO
     */
    public function getPDO()
    {
        if ($this->pdo === null) {
            $pdo = new PDO(
                'pgsql:host=' .$this->db_host.
                ';port=5432;dbname=' .$this->db_name.
                ';user=' .$this->db_user.
                ';password=' .$this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * @param $statement
     * @return array
     */
    public function query($statement): array
    {
        $request = $this->getPDO()->query($statement);
        return $request->fetchAll(PDO::FETCH_OBJ);
    }
}
