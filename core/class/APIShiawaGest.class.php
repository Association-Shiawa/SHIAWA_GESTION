<?php

/**
 * Description of APIShiawaGest
 *
 * Ceci est la classe destinée à l'API de SHIAWA GEST
 * C'est une prémice ... première fois que je souhaite en coder une
 * nativement en prenant gaffe au routage des ressources
 * @author moule
 */
class APIShiawaGest {

    public $header;

    public function __construct() {
        
    }

    /**
     * Déploit le header pour le retour
     */
    public function createHeader(): void {
        header('Content-Type: application/json; charset=utf-8');
    }

    /**
     * Partie principale de notre classe API
     * Elle route en fonction de query, construit le résultat et renvois la
     * chaîne JSON
     * @param type $query
     */
    public function routing() {
        $methodUsed = $_SERVER['REQUEST_METHOD'];
        $content = array();
        switch ($methodUsed) {
            case 'PUT':
                parse_str(file_get_contents('php://input'), $_PUT);
                break;
            case 'POST':

                break;
            case 'GET':
                return $this->get();
                break;
            case 'DELETE':

                break;
        }
    }

    /**
     * Ajoute des informations sur le résultat de la requête
     * @param type $ressource
     * @return array
     */
    public function informationsAPI($ressource): array {
        return array(
            "Ressource" => $ressource,
            "DateProcessingApi" => (new DateTime())->format("Y-m-d H:i:s")
        );
    }

    public function get(): array {
        $ressource = $_GET['ressource'] ?? '';
        $id = $_GET['id'] ?? '';
        #Routing des demandes : 
        switch ($ressource) {
            case 'adherents': #Cas pour lister tous les adhérents
                return array(
                    "HEAD" => $this->informationsAPI("Adherent (ALL)"),
                    "DATA" => AdherentManager::getAdherents(true)
                );
                break;
            case 'adherent': # On va chercher une seule ressource
                return array(
                    "HEAD" => $this->informationsAPI("Adherent (ALL)"),
                    "DATA" => AdherentManager::getAdherent($id)
                );
                break;
        }
        return array(
        "HEAD" => $this->informationsAPI("Adherent (ALL)"),
        "METHOD" => $_SERVER['REQUEST_METHOD'],
        "DATA" => array("Aucune ressource trouvée")
        );
    }

}
