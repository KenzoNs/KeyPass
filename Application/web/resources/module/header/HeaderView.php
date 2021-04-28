<?php
class HeaderView {
    function displayHeader($title) { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>SpeedRunnerTV : <?=$title?></title>
            <link rel="stylesheet" href="css/normalize.css">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="css/global.css">
        </head>
    <body onload="init()">
    <header>
        <nav>
            <a href="?module=acceuil">SpeedRunnerTV</a>
            <a href="?module=jeu">Jeux</a>
            <a href="?module=categorie">Catégories</a>
            <a href="?module=evenement">Evénements</a>
            <a href="#">Règles</a>
            <a href="#" id="linkRecherche">Rechercher</a>
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
        </div>
    </header>
    <?php }
}