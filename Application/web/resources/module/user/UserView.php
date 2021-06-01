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
            <form action="?module=user&action=doCreateUser" style="display: flex; width: 100%; flex-direction: column; flex: 1;" method="post">
                <div class="medium_bottom_marge" style="display: flex; flex: 1; align-items: center">
                    <div style=" display: flex; flex: 1;  width: 50%; align-items: center; flex-direction: column;">
                        <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" for="user_mat">Matricule (*):</label>
                            <input id="user_mat" tabindex="1" class="all_border_radius small_height" style="width: 250px" type="text" name="user_mat" value="<? if (isset($_SESSION['cuser_mat'])) echo $_SESSION['cuser_mat'] ?>" placeholder="Matricule utilisateur"" required>
                        </div>

                        <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" for="user_fname">Nom (*):</label>
                            <input id="user_fname" tabindex="2" class="all_border_radius small_height" style="width: 250px" type="text" name="user_fname" value="<? if (isset($_SESSION['cuser_fname'])) echo $_SESSION['cuser_fname'] ?>" placeholder="Nom utilisateur" required>
                        </div>

                        <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" for="user_name">Prénom (*):</label>
                            <input id="user_name" tabindex="3" class="all_border_radius small_height" style="width: 250px" type="text" name="user_name" value="<? if (isset($_SESSION['cuser_name'])) echo $_SESSION['cuser_name'] ?>" placeholder="Prénom utilisateur" required>
                        </div>

                        <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" for="user_identifiant">Identifiant (*):</label>
                            <input id="user_identifiant" tabindex="4" class="all_border_radius small_height" style="width: 250px" type="text" name="user_identifiant" value="<? if (isset($_SESSION['cuser_identifiant'])) echo $_SESSION['cuser_identifiant'] ?>" placeholder="Identifiant utilisateur" required>
                        </div>

                        <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" for="user_rank">Grade(*) :</label>
                            <input id="user_rank" tabindex="5" class="all_border_radius small_height" style="width: 250px" type="text" name="user_rank" value="<? if (isset($_SESSION['cuser_rank'])) echo $_SESSION['cuser_rank'] ?>" placeholder="Grade utilisateur" required>
                        </div>

                        <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" for="user_function">Fonction(*) :</label>
                            <input id="user_function" tabindex="6" class="all_border_radius small_height" style="width: 250px" type="text" name="user_function" value="<? if (isset($_SESSION['cuser_function'])) echo $_SESSION['cuser_function'] ?>" placeholder="Fonction utilisateur" required>
                        </div>

                        <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                            <label style="width:150px" class="" for="user_group">Groupe (*):</label>
                            <select tabindex="7" style="width: 250px" name="user_group" id="user_group" class="button blue small_height all_border_radius">
                                <?
                                while($group = $groups->fetch()){
                                    echo '<option value='.Security::decrypt($group["nom_groupe"]).'>'.ucfirst(Security::decrypt($group["nom_groupe"])).'</option>';
                                }
                                ?>
                            </select>
                        </div>

                       <div style="display: flex; align-items: center; color: var(--white-color);">
                                <label style="width:150px;"  for="user_rules">Administrateur:</label>
                                <input id="user_rules" tabindex="8" class="all_border_radius" style=" width: 250px;" type="checkbox" value="1"  name="user_rules">
                       </div>

                    </div>

                    <div style="display: flex; width: 50%; align-items: center; flex-direction: column;">
                        <div style="width: min-content;">
                             <div style="display: flex; align-items: center;  margin-bottom: var(--medium-marge);color: grey">
                                <label style="width:150px;"  for="user_pass1">Mot de passe (*):</label>
                                <input tabindex="9" class="all_border_radius small_height medium_right_marge" id="user_pass1" style="width: 250px" name="user_pass1" placeholder="Mot de passe utilisateur" type="password" required>
                                <i class="fas fa-eye button blue all_border_radius small_height" onclick="pass('user_pass1')"></i>
                            </div>

                             <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                                <label style="width:150px" for="user_pass2">Confirmer mot de passe (*):</label>
                                <input tabindex="10" class="all_border_radius small_height medium_right_marge" id="user_pass2" style="width: 250px" name="user_pass2" placeholder="Mot de passe utilisateur" type="password" required>
                                <i class="fas fa-eye button blue all_border_radius small_height" onclick="pass('user_pass2')"></i>
                            </div>

                            <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                                <label style="width:150px" for="user_mail">Email :</label>
                                <input id="user_mail" tabindex="11" class="all_border_radius small_height" style="width: 250px" type="text" name="user_mail" value="<? if (isset($_SESSION['cuser_mail'])) echo $_SESSION['cuser_mail']; else echo '@ght-gpne.fr' ?>" placeholder="Email utilisateur">
                            </div>

                            <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                                <label style="width:150px" for="user_phone">Téléphone :</label>
                                <input id="user_phone" tabindex="12" class="all_border_radius small_height" style="width: 250px" type="text" name="user_phone" placeholder="Téléphone utilisateur">
                            </div>

                            <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                                <label style="width:150px" for="user_bip">Bip :</label>
                                <input id="user_bip" tabindex="13" class="all_border_radius small_height" style="width: 250px" type="text" name="user_bip" placeholder="Bip utilisateur">
                            </div>

                            <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                                <label style="width:150px" for="user_edate">Date entrée:</label>
                                <input id="user_edate" tabindex="14" class="all_border_radius small_height medium_right_marge" style="width: 15%;" name="user_edated" placeholder="Jour" type="text">
                                <input tabindex="15" class="all_border_radius small_height medium_right_marge" style="width: 15%;" name="user_edatem" placeholder="Mois" type="text">
                                <input tabindex="16" class="all_border_radius small_height medium_right_marge" style="width: 15%;" name="user_edatey" placeholder="Année" type="text">
                            </div>

                             <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                                <label style="width:150px" for="user_odate">Date sortie:</label>
                                <input id="user_odate" tabindex="17" class="all_border_radius small_height medium_right_marge" style="width: 15%;" name="user_odated" placeholder="Jour" type="text">
                                <input tabindex="18" class="all_border_radius small_height medium_right_marge" style="width: 15%;" name="user_odatem" placeholder="Mois" type="text">
                                <input tabindex="19" class="all_border_radius small_height medium_right_marge" style="width: 15%;" name="user_odatey" placeholder="Année" type="text">
                            </div>

                            <div style="color: var(--white-color); height: 23px">
                                (*) Champs obligatoires
                            </div>

                        </div>
                    </div>
                </div>

                <div id="error_authentication_container" class="small_bottom_marge">
                    <?=$info!=null?''.$info.'':''?>
                </div>

                <div style="display: flex;  width: 100%">
                    <input tabindex="20" class="button green max_width small_height all_border_radius medium_right_marge" type="submit" value="Valider">
                    <a tabindex="21" href="?module=home&action=chooseAction" class="button red max_width small_height all_border_radius ">Annuler</a>
                </div>
            </form>
        </div>
    <?php }



}
