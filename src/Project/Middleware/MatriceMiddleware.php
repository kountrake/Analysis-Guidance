<?php

namespace Project\Middleware;

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


    /**
     * transforme l'objet renvoyé en tableau de chaines de caractères sans copier les doublons
     * @param $resReq
     * @param $property
     * @return array
     */
    public function requestObjectToArray($resReq, $property)
    {
        $res = array();
        for ($i=0; $i < sizeof($resReq); $i+=1) {
            $string = $resReq[$i] -> $property;
            if (!in_array($string, $res)) {
                array_push($res, $string);
            }
        }
        return $res;
    }


    /**
     * récupère les etapes du projet pour construire la matrice
     * @return array les etapes du projet pour construire la matrice
     */
    public function getEtapesFromStoryMap()
    {
        $stmt = $this->db->getPDO()->prepare(
            'SELECT activite 
                FROM storymap stom
                JOIN flotnarattion flon ON stom.idbut = flon.idbut
                WHERE idprojet=:projectId'
        );
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);

        /*echo '<pre>';
        var_dump($stmt->fetchAll());
        die();
        echo '</pre>';*/

        $resReq = $stmt->fetchAll();

        //transforme l'objet renvoyé en tableau de chaines de caractères sans copier les doublons
        return $this->requestObjectToArray($resReq, 'activite');
    }


    /*
     * @return array recupere les exigences du projet pour construire la matrice
     */
    public function getExigencesFromStoryMap()
    {
        $stmt = $this->db->getPDO()->prepare(
            'SELECT description
                FROM storymap stom
                JOIN flotnarattion flon ON stom.idbut = flon.idbut
                JOIN story stor ON flon.idactivite = stor.idactivite
                WHERE idprojet=:projectId'
        );
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);

        /*
        echo '<pre>';
        var_dump($stmt->fetchAll());
        die();
        echo '</pre>';
        */
        $resReq = $stmt->fetchAll();

        //transforme l'objet renvoyé en tableau de chaines de caractères sans copier les doublons
        return $this->requestObjectToArray($resReq, 'description');
    }


    /*
     * forme et renvoie le tableau $couverture qui indique quelle etape et couvertte par quelles exigences
     *  ( tableau en 2D clé : étape => valeurs[exigences] )
     */
    public function getCouvertureFromStoryMap($etapes)
    {
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

            $stmt->execute($values);

            $resReq = $stmt->fetchAll();
            $arrayReq = $this->requestObjectToArray($resReq, 'description');

            $couverture[$etapes[$i]] = $arrayReq;
        }

        /*
        echo '<pre>';
        var_dump($couverture);
        die();
        echo '</pre>';
        */
        return $couverture;
    }


    /*
     * @return array récupère la matrice du projet (seulement les cases qui contiennent TRUE)
     */
    public function getCouvertureFromMatrix()
    {
        $stmt = $this->db->getPDO()->prepare(
            'SELECT etm.description, exm.description, coche
                FROM etapesmatrice etm 
                JOIN correspond cor ON etm.etapidetape=cor.idetape 
                JOIN exigencesmatrice exm ON cor.idexigence = exm.idexigence 
                WHERE idprojet=:projectId
                AND coche = TRUE'
        );
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }


    /*
     * convertis le résultat de la requête sql en un array php à deux dimensions
     */
    public function matrixDataToToArray($etapes, $exigences, $couverture)
    {
        //initialise l'array en 2D
        $result = array(
            'etapes' => $etapes
        );

        /*
         * initialise chasue sous tableau du resultat avec comme clef le nom de l'exigence
         * et comme valeur un tableau de true/false
         */
        foreach ($exigences as $exigence) {
            $result[$exigence] = array();
            for ($i = 0; $i < sizeof($exigences); $i+=1) {
                if (in_array($exigences, $couverture)) {
                    $result[$exigences][$i] = true;
                } else {
                    $result[$exigences][$i] = false;
                }
            }
        }
        return $result;
    }


    /*
     * créé la matrice dans la BDD avec les cases précochées par rapport au classement des exigences dans la storyMap
     * (ici dans $couverture on a des tableaux avec pour id l'etape et pour valeur les exigences pour
     * indiquer quelles cases précocher)
     */
    public function create($etapes, $exigences)
    {
        //renseigne les etapes de la matrice de couverture du projet dans la table EtapesMatrice
        for ($i = 0; $i < sizeof($etapes); $i += 1) {
            $stmt = $this->db->getPDO()->prepare(
                'INSERT INTO etapesMatrice (description, idprojet)
                     VALUES (:description, :projectId);'
            );
            $values = array(':description' => $etapes[$i], ':projectId' => $this->projectId);
            $stmt->execute($values);
        }

        //renseigne les exigences de la matrice de couverture du projet dans la table ExigencesMatrice
        for ($i = 0; $i < sizeof($exigences); $i += 1) {
            $stmt = $this->db->getPDO()->prepare(
                'INSERT INTO exigencesMatrice (description)
                     VALUES (:description);'
            );
            $values = array(':description' => $exigences[$i]);
            $stmt->execute($values);
        }

        /*
         * renseigne les correspondances entre les exigences et les étapes
         * pour représenter les cases de la matrice dans la BDD
         */
        for ($k = 0; $k < sizeof($etapes); $k += 1) {
            for ($l = 0; $l < sizeof($exigences); $l += 1) {
                $stmt = $this->db->getPDO()->prepare(
                    'INSERT INTO Correspond (idEtape, idExigence, coche)
                            VALUES (
                                    (SELECT idEtape
                                     FROM etapesMatrice
                                     WHERE description = :descEtape
                                     AND idprojet = :idprojet),
                                    
                                    (SELECT idExigence
                                     FROM exigencesMatrice
                                     WHERE description = :descExigence
                                     AND idprojet = :idprojet),
                                    
                                    FALSE
                                     )'
                );
                $values = array(':descEtape' => $etapes[$k], ':descExigence' => $exigences[$l], ':idprojet' => $this->projectId);
                $stmt->execute($values);
            }
        }
    }


    /*
     * initialise les cases de la matrice qui sont cochées par défaut après
     * la création de la matrice en mettant à jour la table Correspond
     */
    public function initiateMatrixValues($couverture)
    {
        /*
         * itère sur un array qui a pour cléf 'etape'
         * et pour valeurs array['exigence] pour voir sous quelles étapes sont classées les exigences
         */
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
                $values = array(':etapeCouv' => $etapeCouv, ':exigenceCouv' => $exigencesCouv[$i]);
                $stmt->execute($values);
            }
        }
    }


    /*
     * repasse toutes les cases de la matrice d'un projet à false
     */
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


    /*
     * remet à FALSE, puis met à jour les cases indiquées
     * dans $couverture en utilisant reset() et initiateMatrixValues($couverture)
     */
    public function update($etapes, $exigences, $couverture)
    {
        $this -> reset($etapes, $exigences);
        $this -> initiateMatrixValues($couverture);
    }


    /*
     * supprime de la BDD les données des tables etapesMatrice/exigencesMatrice
     */
    public function simpleDeleteMatrixValues($values, $tableName)
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


    /*
     * supprime la matrice de la BDD
     */
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
        $this -> simpleDeleteMatrixValues($etapes, 'EtapesMatrice');

        //supprime les données dans la table ExigencesMatrice
        $this -> simpleDeleteMatrixValues($exigences, 'ExengesMatrice');
    }
    public function GetnumberTrueByExigence($exigenceid)
    {
        $stmt = $this->db->getPDO()->prepare(
            'SELECT count(coche) as cou
                FROM etapesmatrice etm 
                JOIN correspond cor ON etm.idetape=cor.idetape 
                WHERE idprojet=:projectId
                AND coche = TRUE
                And idexigence=:exigenceid'
        );
        $values = array(':projectId' => $this->projectId,'exigenceid'=> $exigenceid);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    public function GetAllExigence()
    {
        $stmt = $this->db->getPDO()->prepare(
            'SELECT exm.idexigence as exi
                FROM etapesmatrice etm 
                JOIN correspond cor ON etm.idetape=cor.idetape 
                JOIN exigencesmatrice exm ON cor.idexigence = exm.idexigence 
                WHERE idprojet=:projectId
                AND coche = TRUE'
        );
        $values = array(':projectId' => $this->projectId);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }
}
