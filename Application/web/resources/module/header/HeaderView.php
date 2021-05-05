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
            <link rel="stylesheet" href="./resources/css/header.css">
            <?=$module!=null?'<link rel="stylesheet" href="./resources/css/'.$module.'.css">':''?>
            <script src="javascript/javascript.js"></script>
        </head>
    <body>
        <header>
            <nav>
                <div id="nav_container">
                    <div id="left_nav_div">
                        <a class="button blue left logo" href="?module=home"><i class="fas fa-home fa-lg"></i></a>
                        <form id="nav_search" action="?module=home&action=search" method="get">
                            <input id="input_nav" type="text" name="search" placeholder="Rechercher">
                            <select id="select_nav_div">
                                <option value="account" selected>compte</option>
                                <option value="user">utilisateur</option>
                                <option value="group" >groupe</option>
                            </select>
                            <input class="submit" type="submit" value="Rechercher">
                        </form>
                    </div>
                    <div id="right_nav_div">
                        <a id="profil_button_nav" href="?module=user&action=viewMyAccount"><i id="user_nav_icon" class="far fa-user fa-lg" ></i><? echo Security::decrypt($_SESSION['user']['id_utilisateur'])?></a>
                        <? if($_SESSION['user']['privileges'] == 2) echo "<a id=\"profil_button_nav\" href=\"#\">Panel admin</a>"?>
                        <a id="disconnect_button" href="?module=user&action=disconnection"><i id="disconnection_nav_icon" class="fas fa-power-off fa-lg"></i>Déconnexion</a>
                    </div>
                </div>
            </nav>
        </header>
    <?php }
}