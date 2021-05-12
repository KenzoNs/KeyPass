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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="./resources/js/main.js"></script>
        </head>
    <body>
        <header>
            <nav>
                <div id="nav_container">
                    <div id="left_nav_div">
                        <a class="button blue small_height all_border_radius medium_right_marge" href="?module=home"><i class="fas fa-home fa-lg"></i></a>
                        <input class="left_border_radius" id="search-input" type="text" name="search" onkeyup="callSearchTimer()" placeholder="Rechercher" required>
                        <select name=type" id="search_type" class="button blue small_height right_border_radius">
                            <option value="user" selected>utilisateur</option>
                            <option value="group" >groupe</option>
                        </select>
                    </div>
                    <div id="right_nav_div">
                        <a class="button blue medium_left_marge medium_right_marge all_border_radius" href="?module=user&action=viewMyAccount"><i class="icon_marge far fa-user fa-lg" ></i><? echo Security::decrypt($_SESSION['user']['identifiant_utilisateur'])?></a>
                        <? if($_SESSION['user']['privilege_utilisateur'] == 1) echo "<a class=\"button blue medium_right_marge all_border_radius\" href=\"#\">Panel admin</a>"?>
                        <a class="button red all_border_radius" href="?module=user&action=disconnection"><i class="icon_marge fas fa-power-off fa-lg"></i>Déconnexion</a>
                    </div>
                </div>
            </nav>
        </header>
    <?php }

}