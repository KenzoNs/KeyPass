<?php
include_once ("./resources/module/header/HeaderModel.php");
include_once ("./resources/module/header/HeaderView.php");
include_once ("./resources/include/Security.php");
include_once ("./resources/include/Controller.php");
include_once ("./resources/include/Utils.php");

class HeaderController extends Controller {

    public function __construct() {
        parent::__construct(new HeaderModel(), new HeaderView());
    }

    public function header($title){
        $module = Utils::get("module", "home");
        $this->getView()->displayheader($title, $module);
    }

}
