<?php

/*
 * Classe de gestion database par Fabien MOULET pour AQR
 * Use : Instancier l'objet Database() pour déclarer une connexion MySQL.
 */

class Database {

    protected $connect;
    private $MySQL_HOST;
    private $MySQL_DB;
    private $MySQL_USER;
    private $MySQL_PASSWORD;

    public function __construct() {
        require('config.inc');

        $this->MySQL_HOST = $server;
        $this->MySQL_USER = $user;
        $this->MySQL_PASSWORD = $password;
        $this->MySQL_DB = $db;
        //initialisation de la connexion PDO :
        $this->connect = $this->connectSQL();
    }

    /**
     * Fonction de connexion à PDO !
     * 
     * @return \PDO
     */
    public function connectSQL(): PDO {
        try {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $co = new PDO('mysql:host=' . $this->MySQL_HOST . ';dbname=' . $this->MySQL_DB, $this->MySQL_USER, $this->MySQL_PASSWORD, array(PDO::ATTR_PERSISTENT => true, PDO::ERRMODE_EXCEPTION => true));
            $co->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            new Logs("Erreur SQL : " . $e->getMessage(), 1);
            die('SQL error: ' . $e->getMessage());
        }
        return $co;
    }

    /**
     * Récupère la connexion ouverte actuelle
     * @return type
     */
    public function getInstance(): PDO {
        return $this->connect;
    }

    /**
     * Exécute une requête simple
     * 
     * @param type $sql
     * @return array
     */
    public function getData($sql): array {
        $req = $this->connect->prepare($sql);
        $req->execute();
        $table = array();
        for ($i = 0; $i < $req->rowCount(); $i++) {
            array_push($table, $req->fetch());
        }
        return $table;
    }

}

?>