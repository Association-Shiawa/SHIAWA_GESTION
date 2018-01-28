<?php

/**
 * 
 * CONTROLLEUR (maison)
 * de l'application de gestion
 * SHIAWA GESTION
 * 
 * Par Fabien MOULET
 * 
 */

/**
 * Test si le module est bien appelé dans l'URL
 */
if (isset($_GET['module'])) {
    $module = $_GET['module'] ?? "login";
} else {
    $module = "login";
}

/**
 * Test d'authentification
 */

if(isset($_SESSION['logged'])){
    if($_SESSION['logged'] == false){
        $module = "login";
    }
} else {
    $module = "login";
}

## Inclusion header
include("./structure/header.php");
if (is_dir("./modules/".$module)) {
    if(file_exists("./modules/".$module."/module.php")){
        //Le module existe, alors inclusion
        
        require './modules/'.$module.'/module.php';
    } else {
        //Le module n'existe pas encore, on ne charge rien et on retourne une erreur 403
        header("HTTP/1.0 403");
    }
} else {
    echo "ERREUR : Le répertoire du module ./modules/" . $module . " n'existe pas";
}

include("./structure/footer.php");