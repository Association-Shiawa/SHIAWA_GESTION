<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdherentManager
 *
 * Classe manager, qui opère des actions sur les entités et les persiste si besoin
 * @author moule
 */
class AdherentManager {
    
    /**
     * Fonction de récupération des adhérents présents dans le système
     */
    public static function getAdherents($valid = true): array{
        $v = ($valid == true ? 1 : 0);
        $sql = "SELECT * FROM adherents";
        $db = (new Database())->getInstance();
        $query = $db->prepare($sql);
        $query->execute();
        $adherents = array();

        while($d = $query->fetch(PDO::FETCH_OBJ)){
            $a = (new Adherent());
            $a->init($d->A_ID);
            
            array_push($adherents, $a);
        }
        return $adherents;
    }
    
    /**
     * Renvois un adhérent accédé par l'ID $id
     * @param type $id
     * @return \Adherent
     */
    public static function getAdherent($id): array{
        $a = new Adherent();
        $a->init($id);
        $rtrn = array();
        array_push($rtrn, $a);
        return $rtrn;
    }
    
}
