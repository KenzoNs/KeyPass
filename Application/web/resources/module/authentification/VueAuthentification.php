<?php
class VueAuthentification {
    function display($module, $title, $utilisateurConnecte) {
        if($utilisateurConnecte == null){?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Keypass : <?=$title?></title>
                <link rel="stylesheet" href="css/normalize.css">
                <link rel="stylesheet" href="css/global.css">
                <?=$module!=null?'<link rel="stylesheet" href="css/'.$module.'.css">':''?>
            </head>
            <main>
                <form action="?module=utilisateur&action=login" method="post">
                    <div>
                        <label for="identifiant_utilisateur">Identifiant utilisateur: </label>
                        <input type="text" name="identifiant_utilisateur" id="identifiant_utilisateur">
                    </div>
                    <div>
                        <label for="mot_de_passe">Mot de passe: </label>
                        <input type="password" name="mot_de_passe" id="mot_de_passe">
                    </div>
                    <input type="submit" value="Connexion">
                </form>
            </main>
            </html>
        <?php }
        else{

        }
    }

}