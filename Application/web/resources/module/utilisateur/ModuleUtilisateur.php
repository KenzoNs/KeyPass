
<?php
include_once("ControleurUtilisateur.php");

class ModuleUtilisateur {

    private $controller;

    function __construct() {
        $this->controller = new ControleurUtilisateur();

        $action = Utils::get("action", "authentification");

        switch ($action) {
            case "login":
                $this->controller->login();
                break;
            case "authentification":
                $this->controller->displayLoginPage();
                break;
            case "recupmotdepasse":
                $this->controller->recupmotdepasse();
                break;
            case "dorecupmotdepasse":
                $this->controller->dorecupmotdepasse();
                break;
            case "changemotdepasse":
                $this->controller->changemotdepasse();
                break;
            case "dochangemotdepasse":
                $this->controller->dochangemotdepasse();
                break;
            case "logout":
                $this->controller->logout();
                break;
            case "inscription":
                $this->controller->inscription();
                break;
            case "doinscription":
                $this->controller->doinscription();
                break;
            case "monprofil":
                $this->controller->monprofil();
                break;
            default:
                Utils::error();
        }
    }
}
