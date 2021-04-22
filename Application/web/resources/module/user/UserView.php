<?php
class UserView {
    public function loginPage($module, $error) {?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Authentification</title>
                <link rel="stylesheet" href="css/normalize.css">
                <link rel="stylesheet" href="css/global.css">
                <?=$module!=null?'<link rel="stylesheet" href="css/'.$module.'.css">':''?>
            </head>
            <main>
                <h1>Login</h1>
                <form action="?module=user&action=login" method="post">
                    <div>
                        <label for="identifiant_utilisateur">Identifiant utilisateur: </label>
                        <input type="text" name="identifiant_utilisateur" id="identifiant_utilisateur">
                    </div>
                    <div>
                        <label for="mot_de_passe">Mot de passe: </label>
                        <input type="password" name="mot_de_passe" id="mot_de_passe">
                    </div>
                    <?=$error!=null?'<div class="error">'.$error.'</div>':''?>
                <input type="submit" value="Connexion">
            </form>
        </main>
    <?php }
}
