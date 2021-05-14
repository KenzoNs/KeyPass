<?php
class UserView {
    public function loginPage($info) {?>
        <!DOCTYPE html>
        <div lang="fr">
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

    public function search($qUser){

        if(!is_null($qUser)){?>
            <div>
                <table>
                    <tr>
                        <th><p>matricule</p></th>
                        <th><p>nom</p></th>
                        <th><p>prénom</p></th>
                        <th><p>identifiant</p></th>
                        <th><p>email</p></th>
                        <th><p>téléphone</p></th>
                        <th><p>bip</p></th>
                        <th><p>mot de passe</p></th>
                        <th><p>groupe</p></th>
                        <th><p>grade</p></th>
                        <th><p>fonction</p></th>
                        <th><p>date entrée</p></th>
                        <th><p>date sortie</p></th>
                    </tr>
                    <?while($user = $qUser->fetch()){?>
                        <tr>
                            <td><? echo Security::decrypt($user['matricule_utilisateur'])  ?></td>
                            <td><? echo Security::decrypt($user['nom_utilisateur']) ?></td>
                            <td><? echo Security::decrypt($user['prenom_utilisateur']) ?></td>
                            <td><? echo Security::decrypt($user['identifiant_utilisateur']) ?></td>
                            <td><? echo Security::decrypt($user['email_utilisateur']) ?></td>
                            <td><? echo Security::decrypt($user['telephone_utilisateur']) ?></td>
                            <td><? echo Security::decrypt($user['bip_utilisateur']) ?></td>
                            <td><? echo Security::decrypt($user['mot_de_passe_utilisateur']) ?></td>
                            <td><? echo Security::decrypt($user['nom_groupe_utilisateur']) ?></td>
                            <td><? echo Security::decrypt($user['grade_utilisateur']) ?></td>
                            <td><? echo Security::decrypt($user['fonction_utilisateur']) ?></td>
                            <td><? echo $user['date_entree_utilisateur'] ?></td>
                            <td><? echo $user['date_sortie_utilisateur'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php }
    }
}
