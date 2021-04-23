<?php

include_once ("./resources/include/ModuleManager.php");
include_once ("./resources/include/Url.php");
include_once ("./resources/include/Utils.php");

header( 'content-type: text/html; charset=utf-8');

$module = ModuleManager::getCurrentModule();
Url::init();
if($module == null) {
    ModuleManager::loadModule("user");
}
else {
    ModuleManager::loadModule($module);
}