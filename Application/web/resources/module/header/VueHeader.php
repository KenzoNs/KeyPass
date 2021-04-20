<?php
class VueHeader {
    function display_header($module, $title, $utilisateurConnecte, $js) { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>SpeedRunnerTV : <?=$title?></title>
            <link rel="stylesheet" href="css/normalize.css">
            <link rel="stylesheet" href="css/global.css">
        </head>
    <body>
    <header>
        <nav>
            <a href="?module=acceuil">SpeedRunnerTV</a>
            <a href="?module=jeu">Jeux</a>
            <a href="?module=categorie">Catégories</a>
            <a href="?module=evenement">Evénements</a>
            <a href="#">Règles</a>
            <a href="#" id="linkRecherche">Rechercher</a>
            <a href="#" <?=$utilisateurConnecte==null?'class="nonconnecte"':"" ?> id="linkCompte">Mon compte</a>
        </nav>
        <div id="recherche">
            <form action="" method="get">
                <input type="hidden" name="module" value="acceuil">
                <input type="hidden" name="action" value="recherche">
                <input type="text" name="search">
                <input type="checkbox" name="utilisateur" id="utilisateur" value="1"> <label for="utilisateur">Utilisateurs</label>
                <input type="checkbox" name="video" id="video" value="1"> <label for="video">Vidéos</label>
                <input type="checkbox" name="evenement" id="evenement" value="1"> <label for="evenement">Evénements</label>
                <input type="submit" value="Rechercher">
            </form>
        </div>
        <div id="compte">
            <?php
            if($utilisateurConnecte!=null) {
                ?>
                <div class="title">Bienvenue</div>
                <div class="utilisateur"><em>
                        <?=$utilisateurConnecte['sexe'] == 'homme'?"Mr":"Mme"?>
                        <?=$utilisateurConnecte['prenom']?>
                        <?=$utilisateurConnecte['nom']?>
                    </em></div>
                <a href="?module=utilisateur&action=monprofil">Accèder à votre compte</a>
                <a href="?module=utilisateur&action=logout">Se déconnecter</a>
                <?php
                if($utilisateurConnecte['is_admin'] == 1) {
                    ?>
                    <a href="?module=admin">Interface d'admin</a>
                    <?php
                }
            } else {
                ?>
                <div class="title">Connexion</div>
                <form action="?module=utilisateur&action=login" method="post">
                    <div>
                        <label for="nom_utilisateur">Nom d'utilisateur</label>
                        <input type="text" name="nom_utilisateur" id="nom_utilisateur"/>
                    </div>
                    <div>
                        <label for="mot_de_passe">Mot de passe</label>
                        <input type="password" name="mot_de_passe" id="mot_de_passe"/>
                    </div>
                    <input type="submit" value="Connexion">
                </form>
                <a href="?module=utilisateur&action=inscription">Créer un compte</a>
                <?php
            }
            ?>
        </div>
    </header>
    <?php }
}