<?php

/**
 * 
 * MODULE LOGIN
 * Give the ability to connect to the application from
 * the MySQL Base
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

print $assetsIncludes;
if (file_exists("modules/".$module."/views/" . $view . ".php")) {
    include("modules/".$module."/views/" . $view . ".php");
}