<?php
include_once ("./resources/include/ModuleManager.php");
include_once ("./resources/include/Utils.php");
include_once ("./resources/include/Utils.php");

session_start();
$module = Utils::get('module');

if ($module == null){
    ModuleManager::loadModule('user');
}
else{
    ModuleManager::loadModule($module);
}
