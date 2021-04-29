<?php
class HeaderView {
    function displayHeader($title, $module) { ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title><?=$title?></title>
            <link rel="stylesheet" href="css/normalize.css">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link rel="stylesheet" href="css/global.css">
            <?=$module!=null?'<link rel="stylesheet" href="css/'.$module.'.css">':''?>
            <script src="javascript/javascript.js"></script>
        </head>
    <header>
    <a href="?module=home">KeePass</a>
        <div id="recherche">
            <form action="?module=home&action=search" method="get">
                <input type="hidden" name="module" value="acceuil">
                <input type="hidden" name="action" value="recherche">
                <input type="text" name="search">
                <input type="checkbox" name="utilisateur" id="utilisateur" value="1"> <label for="utilisateur">Utilisateurs</label>
                <input type="checkbox" name="video" id="video" value="1"> <label for="video">Vidéos</label>
                <input type="checkbox" name="evenement" id="evenement" value="1"> <label for="evenement">Evénements</label>
                <input type="submit" value="Rechercher">
            </form>
        </div>
        <a href="?module=user&action=viewMyAccount"><? echo Security::decrypt($_SESSION['user']['nom']), ' ', Security::decrypt($_SESSION['user']['prenom']) ?></a>
        <a href="?module=user&action=disconnection"><button>Déconnexion</button></a>
    </header>
    <?php }
}