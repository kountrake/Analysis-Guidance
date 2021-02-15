<?php 
    try 
    {
        $bdd = new PDO("mysql:host=localhost;dbname=my_table;charset=utf8", "root", "");
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }