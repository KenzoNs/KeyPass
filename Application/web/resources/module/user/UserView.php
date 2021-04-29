<?php
class UserView {
    public function loginPage($error) {?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Authentification</title>
                <link rel="stylesheet" href="../../resources/css/user.css">
                <link rel="stylesheet" href="../../resources/css/global.css">
                <link rel="stylesheet" href="../../resources/css/normalize.css">
            </head>
            <body>
                <div id="main_container">
                    <img src="../../resources/images/banner.png" alt="banner">
                    <form action="?module=user&action=doLogin" method="post">
                        <div>
                            <label for="user_id">Identifiant utilisateur </label>
                            <input type="text" name="user_id" id="user_id" placeholder="Identifiant Utilisateur" required>
                        </div>
                        <div>
                            <label for="user_password">Mot de passe </label>
                            <input type="password" name="user_password" id="user_password" placeholder="Mot de passe" required>
                        </div>
                        <?=$error!=null?'<div class="error">'.$error.'</div>':''?>
                        <input type="submit" value="Connexion">
                    </form>
                </div>
            </body>
    <?php }
}
