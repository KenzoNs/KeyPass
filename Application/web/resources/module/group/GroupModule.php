<?php
include_once ("./resources/module/group/GroupController.php");
include_once ("./resources/include/Module.php");
include_once ("./resources/include/Utils.php");
include_once ("./resources/include/ModuleManager.php");

class GroupModule extends Module {


    public function __construct() {

        $actions = array (
            "createGroup", "doCreateGroup"
        );

        parent::__construct("group", new GroupController, $actions);
        $action = Utils::get('action', 'createGroup');
        parent::initPage($action);
    }
}