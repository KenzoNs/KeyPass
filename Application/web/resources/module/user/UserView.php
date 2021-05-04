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
            <body>
                <div id="main_authentication_container">
                    <div id="img_container">
                        <img src="../../resources/images/banner.png" alt="banner">
                    </div>
                    <form action="?module=user&action=doLogin" method="post">
                        <div class="input_authentication_container">
                            <label id="label_authentication" for="user_id">Identifiant utilisateur </label>
                            <input type="text" name="user_id" id="user_id" placeholder="Entrez votre identifiant utilisateur" required>
                        </div>
                        <div class="input_authentication_container">
                            <label id="label_authentication" for="user_password">Mot de passe </label>
                            <input type="password" name="user_password" id="user_password" placeholder="Entrez votre mot de passe" required>
                        </div>
                        <a href="?module=user&action=sendEmail" id="password_authentication_forget">Mot de passe oublié ?</a>
                        <div id="error_authentication_container">
                            <?=$info!=null?''.$info.'':''?>
                        </div>
                        <input type="submit" value="Connexion">
                    </form>
                </div>
            </body>
    <?php }


    public function sendEmailPage($error) {?>
        <!DOCTYPE html>
        <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Réinitialiser mot de passe</title>
        <link rel="stylesheet" href="../../resources/css/user.css">
        <link rel="stylesheet" href="../../resources/css/global.css">
        <link rel="stylesheet" href="../../resources/css/normalize.css">
    </head>
    <body>
    <div id="main_container">
        <img src="../../resources/images/banner.png" alt="banner">
        <form action="?module=user&action=doSendEmail" method="post">
            <div>
                <label for="user_mail">Email utilisateur</label>
                <input type="text" name="user_mail" id="user_mail" placeholder="Email Utilisateur" required>
            </div>
            <?=$error!=null?'<div class="error">'.$error.'</div>':''?>
            <input type="submit" value="Envoyer">
        </form>
    </div>
    </body>
    <?php }


}
