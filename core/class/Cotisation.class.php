<?php

/**
 * Description of Cotisation
 * 
 * Concerne une cotisation
 *
 * @author moule
 */
class Cotisation {

    //put your code here
    public $id, $montant, $typereglement, $dateEncaissement, $datePaiement;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getInstance();
    }

    /**
     * Récupère et mappe les informations d'une cotisation
     * @param type $idcotisation
     */
    public function init($idcotisation): void {
        $sql = "
SELECT
	cotisations.CT_ID,
	cotisations.CT_MONTANT,
	cotisations.CT_TYPEREGLEMENT,
	cotisations.CT_DATEENCAISSEMENT,
	rel_cotiser.CT_DATE,
	rel_cotiser.CT_ID,
	rel_cotiser.A_ID
FROM
	cotisations
INNER JOIN rel_cotiser ON rel_cotiser.CT_ID = cotisations.CT_ID
WHERE
	cotisations.CT_ID = :idcotisation";
        $query = $this->db->prepare($sql);
        $query->bindParam(":idcotisation", $idcotisation);
        $query->execute();
        while($d = $query->fetch(PDO::FETCH_OBJ)){
            $this->setDateEncaissement($d->CT_DATEENCAISSEMENT);
            $this->setDatePaiement($d->CT_DATE);
            $this->setId($d->CT_ID);
            $this->setMontant($d->CT_MONTANT);
            $this->setTypereglement($d->CT_MONTANT);
        }
    }

    /**
     * GETTERS & SETTERS
     */
    function getId() {
        return $this->id;
    }

    function getMontant() {
        return $this->montant;
    }

    function getTypereglement() {
        return $this->typereglement;
    }

    function getDateEncaissement() {
        return $this->dateEncaissement;
    }

    function getDatePaiement() {
        return $this->datePaiement;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setMontant($montant) {
        $this->montant = $montant;
    }

    function setTypereglement($typereglement) {
        $this->typereglement = $typereglement;
    }

    function setDateEncaissement($dateEncaissement) {
        $this->dateEncaissement = $dateEncaissement;
    }

    function setDatePaiement($datePaiement) {
        $this->datePaiement = $datePaiement;
    }

}
