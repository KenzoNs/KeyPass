<?php

header( 'content-type: text/html; charset=utf-8');
include_once ("./resources/include/Utils.php");


$mod = Utils::get("module");

if($mod == null) {
    $module = Utils::loadModule("utilisateur");
    header("Status: 301 Moved Permanently", false, 301);
    header("Location: ?module=utilisateur&action=authentification");

}
else {
    $module = Utils::loadModule($mod);
}