<?php

include_once ("./resources/include/ModuleManager.php");

header( 'content-type: text/html; charset=utf-8');

$module = ModuleManager::getModule();


if($module == null) {
    ModuleManager::loadModule("user");
}
else {
    ModuleManager::loadModule($module);
}