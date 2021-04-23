<?php
include_once ("./resources/include/Utils.php");
include_once ("./resources/include/Url.php");

class ModuleManager {

    private static Module $module;

    public static array $modules = array(
        "user" => "UserModule",
        "home" => "HomeModule",
        "account" => "AccountModule"
    );

    private static $initialized = false;

    private function __construct() {}

    private static function initialize()
    {
        if (self::$initialized)
            return;
        
        self::$initialized = true;
    }
    static function loadModule($mod)
    {
        if (is_null($mod)) {
            $mod = self::getModule();
        }
        if (is_null($mod) || !array_key_exists($mod, self::$modules)){
            Utils::error();
        }
        include_once ("./resources/module/$mod/".ucwords($mod)."Module.php");
        self::setCurrentModule(new self::$modules[$mod]());
    }

    static function getCurrentModule()
    {
        return self::$module;
    }

    static function setCurrentModule(Module $mod)
    {
        self::$module = $mod;
        if (self::$module == null){
            Utils::error(45353, 'gdf');
        }
        Url::setModuleUrl(self::$module);
    }

}