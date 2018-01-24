<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PeriodeEssai
 * Les informations pour une période d'essai
 * 
 * @author moule
 */
class PeriodeEssai {

    public $id, $message, $dateDebut, $dateFin;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getInstance();
    }

    /**
     * Fonction qui initialise une Periode d'Essai sur un ID
     * @param type $idPe
     */
    public function init($idPe): void {
        $sql = "SELECT * FROM periode_essais WHERE PE_ID = :idpe";
        $query = $this->db->prepare($sql);
        $query->bindParam(":idpe", $idPe);
        $query->execute();
        while($d = $query->fetch(PDO::FETCH_OBJ)){
            $this->setDateDebut($d->PE_DATE_DEBUT);
            $this->setDateFin($d->PE_DATE_FIN);
            $this->setId($d->PE_ID);
            $this->setMessage($d->PE_MESSAGE);
        }
    }

    /**
     * GETTERS & SETTERS
     */
    function getId() {
        return $this->id;
    }

    function getMessage() {
        return $this->message;
    }

    function getDateDebut() {
        return $this->dateDebut;
    }

    function getDateFin() {
        return $this->dateFin;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    function setDateFin($dateFin) {
        $this->dateFin = $dateFin;
    }

}
