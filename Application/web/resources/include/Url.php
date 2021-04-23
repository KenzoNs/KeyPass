<?php

include_once ("./resources/include/Module.php");

class Url{

    private static ?String $url = null;

    private static ?String $mod = null;

    private static ?String $action = null;

    static function init(){
        self::$url = "Location: ?module=".self::$mod."&action=".self::$action."";
    }

    static function getUrl(){
        return self::$url;
    }

    static function setModuleUrl(Module $mod){
        self::$mod = $mod->getName();
    }

    static function setActionUrl(String $action){
        self::$action = $action;
    }

    static function updateUrl(){
        header("Status: 301 Moved Permanently", true, 301);
        header(self::$url);
    }


}
