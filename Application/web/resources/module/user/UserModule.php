
<?php
include_once("UserController.php");
include_once ("./resources/include/Module.php");
include_once ("./resources/include/Utils.php");
include_once ("./resources/include/ModuleManager.php");

class UserModule extends Module {

    public function __construct() {
        $actions = array (
            "loginPage", "doLogin"
        );

        parent::__construct("user", new UserController, $actions);
        $module = ModuleManager::getCurrentModule();
        if($module != null){
            $module->switchPage("loginPage");
        }
        else{
            Utils::error();
        }
    }
}
