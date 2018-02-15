<?php

/**
 * Classe Adherent
 * ==> Recense toutes les informations relatives à une adhérent
 *
 * @author moule
 */
class Adherent {
    # Définition des propriétés

    public $id, $nom, $prenom, $dateNaissance, $adr1, $cp, $ville, $sexe, $telephone, $mail, $dateFinExercice, $isValid, $img;
    public $contacts, $documents, $periodeEssai, $cotisations;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getInstance();
    }

    /**
     * Fonction qui récupère les informations dans la base
     * @param type $id
     */
    public function init($id): void {
        $sql = "SELECT * FROM adherents WHERE A_ID = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(":id", $id);
        $query->execute();
        while ($data = $query->fetch(PDO::FETCH_OBJ)) {
            # Mapping
            $this->setAdr1($data->A_ADR1);
            $this->setCp($data->A_CP);
            $this->setDateFinExercice($data->A_DATE_FIN_EXERCICE);
            $this->setDateNaissance($data->A_DATENAISS);
            $this->setId($data->A_ID);
            $this->setIsValid($data->A_VALIDE);
            $this->setMail($data->A_MAIL);
            $this->setNom($data->A_NOM);
            $this->setPrenom($data->A_PRENOM);
            $this->setSexe($data->A_SEXE);
            $this->setTelephone($data->A_TELEPHONE);
            $this->setVille($data->A_VILLE);
            $this->setImg($data->A_IMG);
        }
        $query->closeCursor();
        
        //Récupération des entités liées
        $this->retrieveCotisations();
        $this->retrieveDocuments();
        $this->retrievePE();
        $this->retrieveContacts();
    }

    /**
     * Fonction qui récupère les cotisations d'un adhérent dans l'ordre
     * chronologique
     */
    public function retrieveCotisations(): void {
        $sql = "SELECT * FROM rel_cotiser WHERE A_ID = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(":id", $this->id);
        $query->execute();
        $cotis = array();
        while ($data = $query->fetch(PDO::FETCH_OBJ)){
            $c = (new Cotisation());
            $c->init($data->CT_ID);
            array_push($cotis, $c);
        }
        $this->cotisations = $cotis;
        $query->closeCursor();
    }
    
    /**
     * Fonction qui récupère les cotisations d'un adhérent dans l'ordre
     * chronologique
     */
    public function retrieveDocuments(): void {
        $sql = "SELECT * FROM documents_adherents WHERE A_ID = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(":id", $this->id);
        $query->execute();
        $docs = array();
        while ($data = $query->fetch(PDO::FETCH_OBJ)){
            $doc = (new Documents());
            $doc->init($data->DA_ID);
            array_push($docs, $doc);
        }
        $this->documents = $docs;
        $query->closeCursor();
    }
    
    /**
     * Fonction qui récupère les cotisations d'un adhérent dans l'ordre
     * chronologique
     */
    public function retrievePE(): void {
        $sql = "SELECT PE_ID FROM periode_essais WHERE A_ID = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(":id", $this->id);
        $query->execute();
        $pes = array();
        while ($data = $query->fetch(PDO::FETCH_OBJ)){
            $pe = (new PeriodeEssai());
            $pe->init($data->PE_ID);
            array_push($pes, $pe);
        }
        $this->periodeEssai = $pes;
        $query->closeCursor();
    }
    
    /**
     * Fonction qui récupère les cotisations d'un adhérent dans l'ordre
     * chronologique
     */
    public function retrieveContacts(): void {
        $sql = "SELECT C_ID FROM rel_rattacher_contact WHERE A_ID = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(":id", $this->id);
        $query->execute();
        $contacts = array();
        while ($data = $query->fetch(PDO::FETCH_OBJ)){
            $contact = (new Contact());
            $contact->init($data->C_ID);
            array_push($contacts, $contact);
        }
        $this->contacts = $contacts;
        $query->closeCursor();
    }

    /**
     * Retourne l'objet au format JSON
     * @return \String
     */
    public function get(): String {
        return json_encode($this);
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

    function getDateFinExercice() {
        return $this->dateFinExercice;
    }

    function getIsValid() {
        return $this->isValid;
    }

    function getContacts() {
        return $this->contacts;
    }

    function getDocuments() {
        return $this->documents;
    }

    function getPeriodeEssai() {
        return $this->periodeEssai;
    }

    function getCotisations() {
        return $this->cotisations;
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

    function setDateFinExercice($dateFinExercice) {
        $this->dateFinExercice = $dateFinExercice;
    }

    function setIsValid($isValid) {
        $this->isValid = $isValid;
    }

    function setContacts($contacts) {
        $this->contacts = $contacts;
    }

    function setDocuments($documents) {
        $this->documents = $documents;
    }

    function setPeriodeEssai($periodeEssai) {
        $this->periodeEssai = $periodeEssai;
    }

    function setCotisations($cotisations) {
        $this->cotisations = $cotisations;
    }
    
    function getImg() {
        return $this->img;
    }

    function setImg($img) {
        $this->img = $img;
    }



}
