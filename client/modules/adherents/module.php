<?php

/**
 * 
 * MODULE ADHERENTS
 * Give the ability to manage all the members of the organization
 * using the MySQL DataBase
 * 
 */
if (isset($_GET['view'])) {
    $view = $_GET['view'] ?? 'index';
} else {
    $view = "index";
}

if(!isset($_SESSION) || count($_SESSION) == 0){
    $view = "index";
}

//On ajoute les assets du module si il y en a
require("assets.php");
$assetsIncludes = "";
foreach ($a as $cat => $files) {
    foreach ($files as $file) {
        switch ($cat) {
            case 'JS':
                $assetsIncludes .= "<script src='modules/".$module.$file."'></script>";
                break;
            case 'CSS':
                //TODO
                break;
        }
    }
}


if (file_exists("modules/".$module."/views/" . $view . ".php")) {
    include("modules/".$module."/views/" . $view . ".php");
}

print $assetsIncludes;