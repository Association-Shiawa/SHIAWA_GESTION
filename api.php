<?php

/**
 * Appel de l'autoloader
 */
require('core/class/Autoloader.class.php');
Autoloader::register();

# ------------------------------------
#
#   API de l'application
#   Elle sert principalement à retourner
#   les données au format JSON
#
# ------------------------------------

$api = new APIShiawaGest();
echo json_encode( $api->routing() );