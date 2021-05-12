<?php
class UserView {
    public function loginPage($info) {?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Authentification</title>
                <link rel="stylesheet" href="../../resources/css/user.css">
                <link rel="stylesheet" href="../../resources/css/global.css">
                <link rel="stylesheet" href="../../resources/css/normalize.css">
            </head>
            <body id="body_authentication">
                <div id="authentication_container">
                    <div id="img_authentication_container">
                        <img src="../../resources/images/banner.png" alt="banner">
                    </div>
                    <form action="?module=user&action=doLogin" method="post">
                        <div class="medium_bottom_marge">
                            <label class="label_authentication" for="user_id">Identifiant utilisateur </label>
                            <input tabindex="1" class="all_width all_border_radius" type="text" name="user_id" placeholder="Entrez votre identifiant utilisateur" required>
                        </div>
                        <div class="small_bottom_marge">
                            <label class="label_authentication" for="user_password">Mot de passe </label>
                            <input tabindex="2" class="small_bottom_marge all_width all_border_radius" type="password" name="user_password" placeholder="Entrez votre mot de passe" required>
                            <a tabindex="4" href="?module=user&action=sendEmail" id="password_authentication_forget">Mot de passe oublié ?</a>

                        </div>

                        <div id="error_authentication_container" class="small_bottom_marge">
                            <?=$info!=null?''.$info.'':''?>
                        </div>
                        <input tabindex="3" class="button green max_width small_height all_border_radius" type="submit" value="Connexion">
                    </form>
                </div>
            </body>
    <?php }

    public function search($user){

        if(!is_null($user)){?>
            <div id="container"><? echo print_r($user) ?></div>
    <?php }
    }
}
