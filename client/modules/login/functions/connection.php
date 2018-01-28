<?php
/**
 * Création du formulaire
 */
if (isset($_POST['login'])) {

    $login = $_POST['identifiant'] ?? "";
    $password = $_POST['password'] ?? "";

    $connect = AdherentManager::connection($login, $password);
    if ($connect) {
        ?>
        <div class="card green">
            <div class="card-content">
                <span class="card-title">Connecté avec succès !</span>
                <p>La conenxion a l'application s'est réalisée avec succès</p>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="card red">
            <div class="card-content">
                <span class="card-title">Erreur d'identification</span>
                <p>Vous vous êtes peut-être trompé de mot de passe ou d'identifiant ?</p>
            </div>
        </div>
        <?php
    }
}

