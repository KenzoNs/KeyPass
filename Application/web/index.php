<?php

include_once ("./resources/include/ModuleManager.php");
include_once ("./resources/include/Utils.php");
include_once ("./resources/include/Url.php");

Url::init();
Url::updateUrl();

$module = Utils::get('module', 'user');
ModuleManager::loadModule($module);
