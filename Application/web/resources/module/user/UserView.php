<?php
class UserView {
    public function loginPage($info=null) {?>
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
                        <th class="test">Matricule</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Identifiant</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Bip</th>
                        <th>Mot de passe</th>
                        <th>Groupe</th>
                        <th>Grade</th>
                        <th>Fonction</th>
                        <th>Date entrée</th>
                        <th>Date sortie</th>
                        <? if($_SESSION['user']['privilege_utilisateur'] == 1)  echo '<th></th>' ?>
                        <? if($_SESSION['user']['privilege_utilisateur'] == 1)  echo '<th></th>' ?>

                    </tr>
                    <tbody>
                        <? $i = 0;
                        while($user = $qUser->fetch()){
                            if ($i++ & 1) { ?>
                                <tr id="tab_pair">
                                    <td><? echo Security::decrypt($user['matricule_utilisateur'])  ?></td>
                                    <td><? echo strtoupper(Security::decrypt($user['nom_utilisateur'])) ?></td>
                                    <td><? echo ucfirst(Security::decrypt($user['prenom_utilisateur'])) ?></td>
                                    <td><? echo Security::decrypt($user['identifiant_utilisateur']) ?></td>
                                    <td><? echo Security::decrypt($user['email_utilisateur']) ?></td>
                                    <td><? echo Security::decrypt($user['telephone_utilisateur']) ?></td>
                                    <td><? echo Security::decrypt($user['bip_utilisateur']) ?></td>
                                    <td><? echo Security::decrypt($user['mot_de_passe_utilisateur']) ?></td>
                                    <td><? echo ucfirst(Security::decrypt($user['nom_groupe_utilisateur'])) ?></td>
                                    <td><? echo ucfirst(Security::decrypt($user['grade_utilisateur'])) ?></td>
                                    <td><? echo ucfirst(Security::decrypt($user['fonction_utilisateur'])) ?></td>
                                    <td><? echo $user['date_entree_utilisateur'] ?></td>
                                    <td><? echo $user['date_sortie_utilisateur'] ?></td>
                                    <? if($_SESSION['user']['privilege_utilisateur'] == 1)  echo '<td><a class="button blue small_height all_border_radius" href="">modifier</a></td>' ?>
                                    <? if($_SESSION['user']['privilege_utilisateur'] == 1) echo '<td><a class="button red small_height all_border_radius" href="">supprimer</a></td>' ?>
                                </tr>
                            <?} else { ?>
                                <tr id="tab_impair">
                                    <td><? echo Security::decrypt($user['matricule_utilisateur'])  ?></td>
                                    <td><? echo strtoupper(Security::decrypt($user['nom_utilisateur'])) ?></td>
                                    <td><? echo ucfirst(Security::decrypt($user['prenom_utilisateur'])) ?></td>
                                    <td><? echo Security::decrypt($user['identifiant_utilisateur']) ?></td>
                                    <td><? echo Security::decrypt($user['email_utilisateur']) ?></td>
                                    <td><? echo Security::decrypt($user['telephone_utilisateur']) ?></td>
                                    <td><? echo Security::decrypt($user['bip_utilisateur']) ?></td>
                                    <td><? echo Security::decrypt($user['mot_de_passe_utilisateur']) ?></td>
                                    <td><? echo ucfirst(Security::decrypt($user['nom_groupe_utilisateur'])) ?></td>
                                    <td><? echo ucfirst(Security::decrypt($user['grade_utilisateur'])) ?></td>
                                    <td><? echo ucfirst(Security::decrypt($user['fonction_utilisateur'])) ?></td>
                                    <td><? echo $user['date_entree_utilisateur'] ?></td>
                                    <td><? echo $user['date_sortie_utilisateur'] ?></td>
                                    <? if($_SESSION['user']['privilege_utilisateur'] == 1)  echo '<td><a class="button blue small_height all_border_radius" href="">modifier</a></td>' ?>
                                    <? if($_SESSION['user']['privilege_utilisateur'] == 1) echo '<td><a class="button red small_height all_border_radius" href="">supprimer</a></td>' ?>
                                </tr>
                            <? }
                        }?>
                    </tbody>
                </table>
            </div>
        <? }
    }

    public function createUserPage($groups, $info=null) {?>
        <div id="container" style="flex-direction: column; align-items: center; justify-content: normal">
            <div style="display: flex; width: 100%; justify-content: center" class="medium_bottom_marge">
                <h2 class="title" >Ajouter un utilisateur</h2>
            </div>
            <form action="?module=user&action=doCreateUser" style="display: flex; width: 100%; flex-direction: column; flex: 1; method="post">
                <div class="medium_bottom_marge" style="display: flex; flex: 1; align-items: center">
                    <div style=" width: 50%; display: flex; flex: 1; align-items: center; flex-direction: column">
                        <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" for="user_mat">Matricule (*):</label>
                            <input tabindex="1" class="all_border_radius small_height" style="width: 250px" type="text" name="user_mat" placeholder="Matricule utilisateur"" required>
                        </div>

                        <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" for="user_mat">Nom (*):</label>
                            <input tabindex="1" class="all_border_radius small_height" style="width: 250px" type="text" name="user_mat" placeholder="Nom utilisateur" required>
                        </div>

                        <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" for="user_mat">Prénom (*):</label>
                            <input tabindex="1" class="all_border_radius small_height" style="width: 250px" type="text" name="user_mat" placeholder="Prénom utilisateur" required>
                        </div>

                        <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" for="user_mat">Identifiant (*):</label>
                            <input tabindex="1" class="all_border_radius small_height" style="width: 250px" type="text" name="user_mat" placeholder="Identifiant utilisateur" required>
                        </div>

                        <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" for="user_mat">Email :</label>
                            <input tabindex="1" class="all_border_radius small_height" style="width: 250px" type="text" name="user_mat" placeholder="Email utilisateur" required>
                        </div>

                        <div style="display: flex; align-items: center">
                            <label style="width:150px" class="" for="user_id">Groupe (*):</label>
                            <select style="width: 250px" name=type" id="search_type" class="button blue small_height all_border_radius">
                                <?
                                while($group = $groups->fetch()){
                                    echo '<option value='.Security::decrypt($group["nom_groupe"]).'>'.ucfirst(Security::decrypt($group["nom_groupe"])).'</option>';
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div style="width: 50%; display: flex; align-items: center; flex-direction: column">
                         <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px;"  for="user_pass">Mot de passe (*):</label>
                            <input tabindex="1" class="all_border_radius small_height medium_right_marge" id="user_pass" style="width: 250px" onfocus="transformText()" onfocusout="transformPass()" name="user_pass" placeholder="Mot de passe utilisateur" required>
                        </div>

                         <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" for="user_mat">Mot de passe (*):</label>
                            <input tabindex="1" class="all_border_radius small_height medium_right_marge" style="width: 250px" type="text" name="user_mat" placeholder="Mot de passe" required>
                        </div>

                    </div>
                </div>


                <div style="display: flex;  width: 100%">
                    <input tabindex="3" class="button green max_width small_height all_border_radius medium_right_marge" type="submit" value="Valider">
                    <a href="?module=home&action=chooseAction" class="button red max_width small_height all_border_radius ">Annuler</a>
                </div>
            </form>
        </div>
    <?php }



}
