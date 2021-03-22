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

    /**
     * @return array Un tableau contenant toutes les users stories d'un projet
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
     * @param string $userStoryId L'ID de la user story à récupérer
     * @return mixed La user story si elle existe, sinon false
     */
    public function getUserStory(string $userStoryId)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM  userstory
                    INNER JOIN verificationbenefice ON userstory.idus = verificationbenefice.idus 
                    WHERE idprojet=:projectId AND verificationbenefice.idus=:userStoryId');
        $values = array(':projectId' => $this->projectId, ':userStoryId' => $userStoryId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    /**
     * Les différents paramètres permettant de créer une user story
     * @param $entantque string Le champ en tant que
     * @param $jeveux string Le champ je veux
     * @param $desorte string Le champ de sorte que
     * @param $critere1 string Le premier critère de satisfaction
     * @param $critere2 string Le second critère de satisfaction
     * @param $critere3 string Le troisième critère de satisfaction
     */
    public function create(
        string $entantque,
        string $jeveux,
        string $desorte,
        string $critere1,
        string $critere2,
        string $critere3
    ) {
        $this->createUserstory($entantque, $jeveux, $desorte);
        $idUs = $this->getLastIdUs()->max;
        $this->createVerificationBenefice($critere1, $critere2, $critere3, $idUs);
    }

    /**
     * Les différents paramètres permettant de mettre à jour une user story
     * @param $entantque string Le champ en tant que
     * @param $jeveux string Le champ je veux
     * @param $desorte string Le champ de sorte que
     * @param $critere1 string Le premier critère de satisfaction
     * @param $critere2 string Le second critère de satisfaction
     * @param $critere3 string Le troisième critère de satisfaction
     * @param $idUs string L'ID de la user story à mettre à jour
     */
    public function update(
        string $entantque,
        string $jeveux,
        string $desorte,
        string $critere1,
        string $critere2,
        string $critere3,
        string $idUs
    ) {
        $this->updateUserstory($entantque, $jeveux, $desorte, $idUs);
        $idVerifications = $this->getIdVerification($idUs);
        $this->updateVerificationBenefice($critere1, $critere2, $critere3, $idVerifications);
    }

    /**
     * @param $id string L'ID de la user story à supprimer
     */
    public function delete(string $id)
    {
        $stmt = $this->db->getPDO()->prepare('DELETE FROM userstory WHERE idus=:id');
        $values = array(':id' => $id);
        $stmt->execute($values);
    }

    /**
     * @return array Retourne l'ensemble des roles d'un projet
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
     * @return array Retourne un tableau contenant tous les je veux d'un projet
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
     * @param $id_us string Met à jour le score d'une user story
     * @param $score float Le score
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
     * @return mixed Retourne le score moyen
     */
    public function getscore_moyen_us()
    {
        $stmt = $this->db->getPDO()->prepare('SELECT avg(score_userstory) as sco FROM UserStory WHERE idprojet=:projectId');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    /**
     * Met à jour la table userstory
     * @param $entantque string le champ en tant que
     * @param $jeveux string le champ je veux
     * @param $desorte string le champ de sorte que
     * @param $idUs int L'ID de la user story à mettre à jour
     */
    public function updateUserstory(string $entantque, string $jeveux, string $desorte, int $idUs): void
    {
        $stmt = $this->db->getPDO()->prepare('UPDATE userstory 
                SET entantque = :entantque, jeveux = :jeveux, desorte = :desorte
                WHERE idus= :id');
        $values = array(':entantque' => $entantque, ':jeveux' => $jeveux, ':desorte' => $desorte, ':id' => $idUs);
        $stmt->execute($values);
    }

    /**
     * Met à jour la table verificationBenefice
     * @param $critere1 string Le premier critere de satisfaction
     * @param $critere2 string Le second critere de satisfaction
     * @param $critere3 string Le troisième critere de satisfaction
     * @param $idverification int L'ID où il faut faire la mise à jour
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
     * Récupère l'ID dans la table verefication benefice
     * @param $idUs int
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
     * Crée une user story  dans la base userstory
     * @param $entantque string le champ en tant que
     * @param $jeveux string le champ je veux
     * @param $desorte string le champ de sorte que
     */
    public function createUserstory(string $entantque, string $jeveux, string $desorte): void
    {
        $stmt = $this->db->getPDO()->prepare(
            'INSERT INTO userstory (entantque, jeveux, desorte, idprojet)
                   VALUES (:entantque, :jeveux, :desorte, :idprojet)'
        );
        $values = array(':entantque' => $entantque, ':jeveux' => $jeveux, ':desorte' => $desorte,
            ':idprojet' => $this->projectId);
        $stmt->execute($values);
    }

    /**
     * @return mixed Le dernier id d'une user story d'un projet
     */
    private function getLastIdUs()
    {
        $stmt = $this->db->getPDO()->prepare('SELECT max(idus) FROM userstory 
                                                    WHERE idprojet=:idprojet');
        $values = array(':idprojet' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetch();
    }

    /**
     * Crée dans la table verification benefice les trois critere de satisfaction d'une user story
     * @param $critere1 string premier critere
     * @param $critere2 string second critere
     * @param $critere3 string troisieme critere
     * @param $idUs int l'ID de la user story
     */
    public function createVerificationBenefice(string $critere1, string $critere2, string $critere3, int $idUs)
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


    /**
     * @param $idUs int l'idée de la user story
     * @return array recupere sous forme de tableau tous les benefices liés à une user story
     */
    public function getBenefice($idUs): array
    {
            $stmt = $this->db->getPDO()->prepare(
                'SELECT * From verificationbenefice
                       Where idus=:idus'
            );
            $values = array(':idus' => $idUs);
            $stmt->execute($values);
            return $stmt->fetchAll();
    }
}
