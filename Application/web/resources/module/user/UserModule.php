
<?php
include_once("UserControler.php");
include_once ("./resources/include/Module.php");

class UserModule extends Module {

    public function __construct() {
        $actions = array (
            "loginPage", "doLogin"
        );

        parent::__construct(new UserControler, $actions);
        $this->switchPage("loginPage");

    }
}
