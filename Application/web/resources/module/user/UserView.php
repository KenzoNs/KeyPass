<?php
class UserView {
    public function loginPage($error) {?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Authentification</title>
                <link rel="stylesheet" href="css/normalize.css">
                <link rel="stylesheet" href="css/global.css">
            </head>
            <main>
                <div id="main_container">
                    <h1>Login</h1>
                    <form action="?module=user&action=doLogin" method="post">
                        <div>
                            <label for="user_id">Identifiant utilisateur: </label>
                            <input type="text" name="user_id" id="user_id">
                        </div>
                        <div>
                            <label for="user_password">Mot de passe: </label>
                            <input type="password" name="user_password" id="user_password">
                        </div>
                        <?=$error!=null?'<div class="error">'.$error.'</div>':''?>
                    <input type="submit" value="Connexion">
                </form>
            </div>
        </main>
    <?php }
}
