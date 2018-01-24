<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Documents
 * Permet de lister les informations propres à un document
 * 
 * @author moule
 */
class Documents {
    
    public $id, $typedoc, $docajour, $dateRemise;
    private $db;
    
    public function __construct() {
        $this->db = (new Database())->getInstance();
    }
    
    /**
     * Initialise les informations d'un document
     * @param type $id
     */
    public function init($id): void{
        $sql = "
SELECT
	documents_adherents.DA_ID,
	documents_adherents.DA_TYPEDOC,
	documents_adherents.DA_DOCAJOUR,
	documents_adherents.R_DATERETOUR,
	documents_adherents.A_ID
FROM
	documents_adherents
WHERE
	documents_adherents.DA_ID = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(":id", $id);
        $query->execute();
        while($d = $query->fetch(PDO::FETCH_OBJ)){
            $this->setDateRemise($d->R_DATERETOUR);
            $this->setDocajour($d->DA_DOCAJOUR);
            $this->setId($d->DA_ID);
            $this->setTypedoc($d->DA_TYPEDOC);
        }
        $query->closeCursor();
    }
    
    /**
     * GETTERS & SETTERS
     */
    
    function getId() {
        return $this->id;
    }

    function getTypedoc() {
        return $this->typedoc;
    }

    function getDocajour() {
        return $this->docajour;
    }

    function getDateRemise() {
        return $this->dateRemise;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTypedoc($typedoc) {
        $this->typedoc = $typedoc;
    }

    function setDocajour($docajour) {
        $this->docajour = $docajour;
    }

    function setDateRemise($dateRemise) {
        $this->dateRemise = $dateRemise;
    }
    
}
