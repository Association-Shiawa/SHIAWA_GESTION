<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contact
 * Classe permettant de reecenser des contacts pour l'association (tuteurs, partenaires etc)
 * @author moule
 */
class Contact {

    public $id, $nom, $prenom, $dateNaissance, $adr1, $cp, $ville, $sexe, $telephone, $mail, $isTutor;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getInstance();
    }

    /**
     * Fonction qui récupère les informations dans la base
     * @param type $id
     */
    public function init($id): void {
        $sql = "SELECT * FROM contacts WHERE C_ID = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(":id", $id);
        $query->execute();
        while ($data = $query->fetch(PDO::FETCH_OBJ)) {
            # Mapping
            $this->setAdr1($data->C_ADR1);
            $this->setCp($data->C_CP);
            $this->setDateNaissance($data->C_DATENAISS);
            $this->setId($data->C_ID);
            $this->setIsTutor($data->C_ISTUTOR);
            $this->setMail($data->C_MAIL);
            $this->setNom($data->C_NOM);
            $this->setPrenom($data->C_PRENOM);
            $this->setSexe($data->C_SEXE);
            $this->setTelephone($data->C_TELEPHONE);
            $this->setVille($data->C_VILLE);
        }
        $query->closeCursor();
    }

    /**
     * GETTERS & SETTERS
     */
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getDateNaissance() {
        return $this->dateNaissance;
    }

    function getAdr1() {
        return $this->adr1;
    }

    function getCp() {
        return $this->cp;
    }

    function getVille() {
        return $this->ville;
    }

    function getSexe() {
        return $this->sexe;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getMail() {
        return $this->mail;
    }

    function getIsTutor() {
        return $this->isTutor;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
    }

    function setAdr1($adr1) {
        $this->adr1 = $adr1;
    }

    function setCp($cp) {
        $this->cp = $cp;
    }

    function setVille($ville) {
        $this->ville = $ville;
    }

    function setSexe($sexe) {
        $this->sexe = $sexe;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setIsTutor($isTutor) {
        $this->isTutor = $isTutor;
    }

}
