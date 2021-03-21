<?php


namespace Project\Middleware;

use phpDocumentor\Reflection\Types\Mixed_;
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

    /**
     * @return array
     */
    public function getAllUserStories(): array
    {
        $stmt = $this->db->getPDO()->prepare(
            'SELECT * FROM  userstory
                    INNER JOIN verificationbenefice ON userstory.idus = verificationbenefice.idus 
                    WHERE userstory.idprojet=:projectId'
        );
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * @param int $userStoryId
     * @return mixed
     */
    public function getUserStory(int $userStoryId)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM  userstory
                    INNER JOIN verificationbenefice ON userstory.idus = verificationbenefice.idus 
                    WHERE idprojet=:projectId AND verificationbenefice.idus=:userStoryId');
        $values = array(':projectId' => $this->projectId, ':userStoryId' => $userStoryId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * @param $entantque
     * @param $jeveux
     * @param $desorte
     * @param $critere1
     * @param $critere2
     * @param $critere3
     */
    public function create(
        $entantque,
        $jeveux,
        $desorte,
        $critere1,
        $critere2,
        $critere3
    ) {
        $this->createUserstory($entantque, $jeveux, $desorte);
        $idUs = $this->getLastIdUs()->max;
        $this->createVerificationBenefice($critere1, $critere2, $critere3, $idUs);
    }

    /**
     * @param $entantque
     * @param $jeveux
     * @param $desorte
     * @param $critere1
     * @param $critere2
     * @param $critere3
     * @param $idUs
     */
    public function update(
        $entantque,
        $jeveux,
        $desorte,
        $critere1,
        $critere2,
        $critere3,
        $idUs
    ) {
        $this->updateUserstory($entantque, $jeveux, $desorte, $idUs);
        $idVerifications = $this->getIdVerification($idUs);
        $this->updateVerificationBenefice($critere1, $critere2, $critere3, $idVerifications);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $stmt = $this->db->getPDO()->prepare('DELETE FROM userstory WHERE idus=:id');
        $values = array(':id' => $id);
        $stmt->execute($values);
    }

    /**
     * @return array
     */
    public function getAllRoles(): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT distinct(entantque) FROM userstory 
                                                    WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * @return array
     */
    public function getAllJeVeux(): array
    {
        $stmt = $this->db->getPDO()->prepare('SELECT distinct(jeveux) FROM userstory 
                                                    WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * @param $id_us
     * @param $score
     */
    public function update_score_us($id_us, $score)
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE userstory 
                SET score_userstory = :score_userstory
                WHERE idus= :idus');
        $values = array(':score_userstory' => $score, ':idus' => $id_us);
        $stmt->execute($values);
    }

    /**
     * @return array
     */
    public function getscore_moyen_us()
    {
        $stmt = $this->db->getPDO()->prepare('SELECT avg(score_userstory) as sco FROM UserStory WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * @param $entantque
     * @param $jeveux
     * @param $desorte
     * @param $idUs
     */
    public function updateUserstory($entantque, $jeveux, $desorte, $idUs): void
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE userstory 
                SET entantque = :entantque, jeveux = :jeveux, desorte = :desorte
                WHERE idus= :id');
        $values = array(':entantque' => $entantque, ':jeveux' => $jeveux, ':desorte' => $desorte, ':id' => $idUs);
        $stmt->execute($values);
    }

    /**
     * @param $critere1
     * @param $critere2
     * @param $critere3
     * @param $idverification
     */
    public function updateVerificationBenefice($critere1, $critere2, $critere3, $idverification)
    {
        $criteres = [];
        $criteres[] = $critere1;
        $criteres[] = $critere2;
        $criteres[] = $critere3;
        for ($i = 0; $i<3; $i++) {
            $stmt = $this->db->getPDO()->prepare('UPDATE verificationbenefice 
                SET description = :critere WHERE idveriffication= :idverification');
            $values = array(':critere' => $criteres[$i], ':idverification' => $idverification[$i]->idveriffication);
            $stmt->execute($values);
        }
    }

    /**
     * @param $idUs
     * @return mixed
     */
    private function getIdVerification($idUs)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT idveriffication FROM verificationbenefice 
                                                    WHERE idus=:idus');
        $values = array(':idus' => $idUs);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * @param $entantque
     * @param $jeveux
     * @param $desorte
     */
    public function createUserstory($entantque, $jeveux, $desorte): void
    {
        $stmt = $this->db->getPDO()->prepare(
            'INSERT INTO userstory (entantque, jeveux, desorte, idprojet)
                   VALUES (:entantque, :jeveux, :desorte, :idprojet)'
        );
        $values = array(':entantque' => $entantque, ':jeveux' => $jeveux, ':desorte' => $desorte,
            ':idprojet' => $this->projectId);
        $stmt->execute($values);
    }

    private function getLastIdUs()
    {
        $stmt = $this->db->getPDO()->prepare('SELECT max(idus) FROM userstory 
                                                    WHERE idprojet=:idprojet');
        $values = array(':idprojet' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    public function createVerificationBenefice($critere1, $critere2, $critere3, $idUs)
    {
        $criteres = [];
        $criteres[] = $critere1;
        $criteres[] = $critere2;
        $criteres[] = $critere3;
        for ($i = 0; $i<3; $i++) {
            $stmt = $this->db->getPDO()->prepare(
                'INSERT INTO verificationbenefice (description, idus)
                       VALUES (:description, :idus)'
            );
            $values = array(':description' => $criteres[$i], ':idus' => $idUs);
            $stmt->execute($values);
        }
    }
}
