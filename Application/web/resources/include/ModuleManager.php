<?php
include_once ("./resources/include/Utils.php");
include_once ("./resources/include/Module.php");
include_once ("./resources/include/Url.php");

class ModuleManager {

    private static ?Module $module=null;

    public static array $modules = array(
        "user" => "UserModule",
        "home" => "HomeModule",
        "account" => "AccountModule"
    );

    private function __construct() {}

    static function loadModule($mod){
        if (is_null($mod) || !array_key_exists($mod, self::$modules)){
            Utils::error();
        }

        include_once ("./resources/module/$mod/".ucwords($mod)."Module.php");

        self::setCurrentModule(new self::$modules[$mod]());


    }

    static function  getCurrentModule(): ?Module{
        return self::$module;
    }

    static function setCurrentModule($mod){
        if ($mod == null){
            self::$module = $mod;
            Url::setModuleUrl(self::$mod->getName());
        }
        else{
            Utils::error();
        }





    }

}