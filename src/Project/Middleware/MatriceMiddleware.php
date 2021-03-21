<?php

namespace Project\Middleware;

use phpDocumentor\Reflection\Types\False_;
use Project\Db\Db;

class MatriceMiddleware
{


    private $db;
    private $projectId;


    /**
     * MatriceMiddleware constructor.
     */
    public function __construct(int $projectId)
    {
        $this->db = new Db();
        $this->projectId = $projectId;
    }

    //récupère les etapes du projet pour construire la matrice
    public function getEtapesFromStoryMap(){
        $stmt = $this->db->getPDO()->prepare(
            'SELECT activite 
                FROM storymap stom
                JOIN flotnarattion flon ON stom.idbut = flon.idbut
                WHERE idprojet=:projectId'
            );
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    //recupere les exigences du projet pour construire la matrice
    public function getExigencesFromStoryMap(){
        $stmt = $this->db->getPDO()->prepare(
            'SELECT description
                FROM storymap stom
                JOIN flotnarattion flon ON stom.idbut = flon.idbut
                JOIN story stor ON flon.idactivite = stor.idactivite
                WHERE idprojet=:projectId'
            );
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    //forme et renvoie le tableau $couverture qui indique quelle etape et couvertte par quelles exigences ( tableau en 2D clé : étape => valeurs[exigences] )
    public function getCouvertureFromStoryMap($etapes){
        $couverture = array();

        for ($i = 0; $i < sizeof($etapes); $i += 1) {
            $stmt = $this->db->getPDO()->prepare(
                'SELECT description
                FROM storymap stom
                JOIN flotnarattion flon ON stom.idbut = flon.idbut
                JOIN story stor ON flon.idactivite = stor.idactivite
                WHERE idprojet = :projectId
                AND activite = :etape'
            );
            $values = array(':projectId' => $this->projectId, ':etape' => $etapes[$i]);
            $resRequete = $stmt->execute($values);

            $couverture[$etapes[i]] = $resRequete;
        }

        return $couverture;
    }

    //récupère la matrice du projet (seulement les cases qui contiennent TRUE)
    public function getCouvertureFromMatrix()
    {
        $stmt = $this->db->getPDO()->prepare(
            'SELECT etm.description, exm.description, coche
                FROM etapesmatrice etm 
                JOIN correspond cor ON etm.etapidetape=cor.idetape 
                JOIN exigencesmatrice exm ON cor.idexigence = exm.idexigence 
                WHERE idprojet=:projectId
                AND coche = TRUE');
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    //convertis le résultat de la requête sql en un array php à deux dimensions
    //todo à finir
    public function dataToArray($etapes, $exigences, $couverture)
    {
        $result = array();
        $result['etapes'] = $etapes;
        foreach ($exigences as $exigence) {
            foreach ($etapes as $etape) {
                $result[$exigence] = -1 ;
            }

        }
    }

    //factorisation de l'INSERT dans les tables EtapesMatrice et ExigencesMatrice
    public function simpleInsertMatrix($values, $tableName)
    {
        for ($i = 0; $i < sizeof($values); $i += 1) {
            $stmt = $this->db->getPDO()->prepare(
                'INSERT INTO :tableName (description, idprojet)
                     VALUES (:description, :projectId);'
            );
            $values = array('tableName' => $tableName, ':description' => $values[$i], ':projectId' => $this->projectId);
            $stmt->execute($values);
        }
    }


    //créé la matrice dans la BDD avec les cases précochées par rapport au classement des exigences dans la storyMap
    // (ici dans $couverture on a des tableaux avec pour id l'etape et pour valeur les exigences pour indiquer quelles cases précocher)
    public function create($etapes, $exigences)
    {
        //renseigne les etapes de la matrice de couverture du projet dans la table EtapesMatrice
        $this->simpleInsertMatrix($etapes, 'EtapesMatrice');

        //renseigne les exigences de la matrice de couverture du projet dans la table ExigencesMatrice
        $this->simpleInsertMatrix($exigences, 'ExigencesMatrice');

        //renseigne les correspondances entre les exigences et les étapes pour représenter les cases de la matrice dans la BDD
        for ($k = 0; $k < sizeof($etapes); $k += 1) {
            for ($l = 0; $l < sizeof($exigences); $l += 1) {
                $stmt = $this->db->getPDO()->prepare(
                    'INSERT INTO Correspond (idEtape, idExigence)
                        SELECT idEtape, idExigence, FALSE
                        FROM EtapesMatrice
                        CROSS JOIN ExigenceMatrice;'
                );
                $stmt->execute();
            }
        }

    }


    //initialise les cases de la matrice qui sont cochées par défaut après la création de la matrice en mettant à jour la table Correspond
    public function initiateMatrixValues($couverture)
    {
        //itère sur un array qui a pour cléf 'etape' et pour valeurs array['exigence] pour voir sous quelles étapes sont classées les exigences
        foreach ($couverture as $etapeCouv => $exigencesCouv) {
            for ($i = 0; $i < sizeof($exigencesCouv); $i += 1) {
                $stmt = $this->db->getPDO()->prepare(
                    'UPDATE Correspond
                    SET coche = TRUE
                    WHERE
                         idEtape = (
                             SELECT idEtape
                             FROM EtapesMatrice
                             WHERE description = :etapeCouv
                             ) 
                      AND idExigence = (
                          SELECT idExigence
                          FROM EtapesMatrice
                          WHERE description = :exigenceCouv
                      )'
                );
                $values = array(':etapeCouv' => $etapeCouv, ':exigenceCouv' => $exigencesCouv[i]);
                $stmt->execute($values);
            }
        }
    }

    //repasse toutes les cases de la matrice d'un projet à FALSE
    public function reset($etapes, $exigences)
    {
        for ($i = 0; $i < sizeof($etapes); $i += 1) {
            for ($j = 0; $j < sizeof($exigences); $j += 1) {
                $stmt = $this->db->getPDO()->prepare(
                    'UPDATE Correspond
                    SET coche = FALSE
                    WHERE
                         idEtape = (
                             SELECT idEtape
                             FROM EtapesMatrice
                             WHERE description = :etapes
                             ) 
                      AND idExigence = (
                          SELECT idExigence
                          FROM EtapesMatrice
                          WHERE description = :exigences
                      )'
                );
                $values = array(':etapes' => $etapes[$i], ':exigences' => $exigences[$i]);
                $stmt->execute($values);
            }
        }
    }

    //remet à FALSE, puis met à jour les cases indiquées dans $couverture en utilisant reset() et initiateMatrixValues($couverture)
    public function update($etapes, $exigences, $couverture)
    {
        this . reset($etapes, $exigences);
        this . $this->initiateMatrixValues($couverture);
    }

    public function simpleDeleteMatrix($values, $tableName)
    {
        for ($i = 0; $i < sizeof($values); $i += 1) {
            $stmt = $this->db->getPDO()->prepare(
                'DELETE FROM :tableName 
                     WHERE description = :description;'
            );
            $values = array('tableName' => $tableName, ':description' => $values[$i]);
            $stmt->execute($values);
        }
    }


    //supprime la matrice de la BDD
    public function delete($etapes, $exigences)
    {
        //supprime les données dans la table Correspond
        for ($i = 0; $i < sizeof($etapes); $i += 1) {
            for ($j = 0; $j < sizeof($exigences); $j += 1) {
                $stmt = $this->db->getPDO()->prepare(
                    'DELETE FROM Correspond
                        WHERE
                         idEtape = (
                             SELECT idEtape
                             FROM EtapesMatrice
                             WHERE description = :etapes
                             ) 
                        AND idExigence = (
                          SELECT idExigence
                          FROM EtapesMatrice
                          WHERE description = :exigences
                      )'
                );
                $values = array(':etapes' => $etapes[$i], ':exigences' => $exigences[$i]);
                $stmt->execute($values);
            }
        }

        //supprime les données dans la table EtapesMatrice
        simpleDeleteMatrixValues($etapes, 'EtapesMatrice');

        //supprime les données dans la table ExigencesMatrice
        simpleDeleteMatrixValues($exigences, 'ExengesMatrice');

    }

}