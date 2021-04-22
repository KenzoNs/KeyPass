<?php
class ModuleManager {

    private static $module;

    public static array $modules = array(
        "user" => "UserModule",
        "home" => "HomeModule",
        "account" => "AccountModule"
    );

    static function loadModule($mod)
    {
        if (is_null($mod)) {
            $mod = self::getModule();
        }
        if (is_null($mod) || !array_key_exists($mod, self::$modules)){
            Utils::error();
        }
        self::$module = $mod;
        include_once ("./resources/module/$mod/".ucwords($mod)."Module.php");
        header("Status: 301 Moved Permanently", true, 301);
        header("Location: ?module=".$mod."");
        return new self::$modules[$mod]();
    }

    static function getModule(){
        return self::$module;
    }

}