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
    
    /**
     * Fonction de connection a l'application (Locale)
     * @param type $login
     * @param type $pass
     * @return bool
     */
    public static function connection($login, $pass): bool{
        $db = (new Database())->getInstance();
        $query = $db->prepare("SELECT * FROM login WHERE L_IDENT = :ident AND L_PASSWORD = :pass");
        $query->bindParam(":ident", $login);
        $query->bindParam(":pass", $pass);
        $query->execute();
        $d = [];
        while($data = $query->fetch()){
            array_push($d, $data);
        }
        if(count($d) == 1){
            //On a bien notre entrée
            //Création de la session
            $_SESSION['logged'] = true;
            $_SESSION['ident'] = $d[0]['L_IDENT'];
            $_SESSION['dateSession'] = (new DateTime())->format("d/m/y H:i:s");
            return true;
        } else {
            return false;
        }
    }
    
}
