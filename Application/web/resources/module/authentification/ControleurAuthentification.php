<?php
include_once ("./resources/module/authentification/ModeleAuthentification.php");
include_once ("./resources/module/authentification/VueAuthentification.php");

/**
 * Controlleur acceuil
 */
class ControleurAuthentification {

    /**
     * Le modèle
     */
    private $model;

    /**
     * La vue
     */
    private $view;

    public function __construct() {

        $this->model = new ModeleAuthentification();
        $this->view = new VueAuthentification();
    }

    function display() {
        $module = Utils::get("module", "authentification");
        $nomUtilisateur = Utils::sessionGet("nom_utilisateur");
        $this->view->display($module, ucwords($module), $this->model->getUtilisateurConnecte($nomUtilisateur));
    }
}
