<?php

/**
 * Réquisition de l'autoloader pour le
 * client
 */

session_start();

require('../core/class/Autoloader.class.php');
Autoloader::register();

include "./controller.php";
