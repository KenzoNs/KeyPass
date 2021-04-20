<?php
include_once("ControleurAuthentification.php");

/**
 * Module page d'acceuil
 */
class ModuleAuthentification {
    private $controleur;

    function __construct() {
        $this->controleur = new ControleurAuthentification();

        $action = Utils::get("action", "authentification");

        switch ($action) {
            case "authentification":
                $this->controleur->display();
                break;
            default:
                Utils::error();
        }
    }
}