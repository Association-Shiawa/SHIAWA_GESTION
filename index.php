<?php
/**
 * Appel de l'autoloader
 */
require('core/class/Autoloader.class.php');
Autoloader::register();

# ------------------------------------
#
#   CONTROLLER DE L'APPLICATION
#   Il gère et route les différentes
#   demandes aux ressources
#
# ------------------------------------

$a = new Adherent();
$a->init(1);
echo $a->get();

?>

