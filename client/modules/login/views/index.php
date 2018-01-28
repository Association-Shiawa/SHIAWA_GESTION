

<div class="container">
    <div class="row">
        <div class="col s12">
            <?php require("modules/" . $module . "/functions/connection.php"); ?>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="card grey lighten-2">
                <div class="card-content">
                    <span class="card-title">Connexion à l'application</span>

                    <div class='row'>
                        <form class="col s12" method="post" action="#">

                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="Inscrivez votre identifiant" name="identifiant" id="first_name" type="text" class="validate">
                                    <label for="first_name">Identifiant</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="last_name" name="password" placeholder="Inscrivez votre password" type="text" class="validate">
                                    <label for="last_name">Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" name="login" class='btn btn-large green'>Se connecter</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>