<?php
class HeaderView {
    function displayHeader($title, $module) { ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title><?=$title?></title>
            <link rel="stylesheet" href="./resources/css/global.css">
            <link rel="stylesheet" href="./resources/css/normalize.css">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link rel="stylesheet" href="./resources/fa/css/all.css">
            <?=$module!=null?'<link rel="stylesheet" href="./resources/css/'.$module.'.css">':''?>
            <script src="javascript/javascript.js"></script>
        </head>
    <header>
        <nav>
            <div id="nav_container">
                <div id="left_nav_div">
                    <a id="logo_nav" href="?module=home"><i class="fas fa-home fa-2x"></i></a>
                    <form id="nav_search" action="?module=home&action=search" method="get">
                        <input id="input_nav" type="text" name="search">
                        <input id="submit_nav" type="submit" value="Rechercher">
                    </form>
                </div>
                <div id="right_nav_div">
                    <button><a href="?module=user&action=viewMyAccount"><i class="far fa-user fa-2x"></i><? echo Security::decrypt($_SESSION['user']['id_utilisateur'])?></a></button>
                    <button id="disconnect_button"><a  id="disconnect_text_button" href="?module=user&action=disconnection">Déconnexion</a></button>
                </div>
            </div>
        </nav>
    </header>
    <?php }
}