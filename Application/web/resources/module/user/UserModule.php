<?php
include_once ("./resources/module/user/UserController.php");
include_once ("./resources/include/Module.php");
include_once ("./resources/include/Utils.php");
include_once ("./resources/include/ModuleManager.php");

class UserModule extends Module {


    public function __construct() {

        $actions = array (
            "login", "doLogin", "disconnection"
        );

        parent::__construct("user", new UserController, $actions);
        $action = Utils::get('action', 'login');
        parent::switchPage($action);
    }
}
