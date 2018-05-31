<?php

namespace App\Model;

use \PDO;

/**
 * @param PDO Gère la connexion à la BDD
 * retun $this->db
 */
abstract class Repository // Utilisation de abstract pour empecher d'instancier cette classe
{
    private $db;
    
    /**
     * @param PDO Gère a connexion à la bdd avec une accesseur pour vérifier si la connexion est deja effectuée
     * return $this->db
     */
    protected function getPDO() // Protected pour laisser accès à la méthode aux classes filles
    {
        $host = 'localhost';
        $dbName = 'test';
        $dbUser = 'root';
        $dbPsw = '';

        if ($this->db === null) {
            try {
                $this->db = new PDO('mysql:host='.$host.';dbname='.$dbName.';charset=utf8', $dbUser, $dbPsw, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (Exception $e) {
                die('Erreur :' .$e->getMessage());
            }
        }
        return $this->db;
    }
}
