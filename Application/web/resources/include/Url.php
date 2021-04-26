<?php

include_once ("./resources/include/Module.php");
include_once ("./resources/include/ModuleManager.php");

class Url{

    private static ?String $url = null;

    private static ?String $module = null;

    private static ?String $action = null;

    private function __construct() {}

    static function init(){
        header( 'content-type: text/html; charset=utf-8');
        self::$url = "Location: ?module=".self::$module."&action=".self::$action."";
    }

    public static function getUrl(): ?string
    {
        return self::$url;
    }

    public static function setModuleUrl($module){
        self::$module = $module;
    }

    public static function setActionUrl($action){
        self::$action = $action;
    }

    public static function updateUrl(){
        header("Status: 301 Moved Permanently", true, 301);
        header(self::$url);
    }


}
