<?php

header( 'content-type: text/html; charset=utf-8' );

include_once ("./resources/include/Utils.php");


$mod = Utils::get("module");

if($mod == null) {
    $module = Utils::loadModule("utilisateur");
}
else {
    $module = Utils::loadModule($mod);
}