<?php
include_once ("/../../include/Utils.php");
include_once ("/ModeleHeader.php");
include_once ("/VueHeader.php");

/**
 * Controlleur header
 */
class ContHeader {
    /**
     * Le modèle
     */
    private $model;

    /**
     * La vue
     */
    private $view;

    public function __construct() {
        $this->model = new ModeleHeader();
        $this->view = new VueHeader();
    }

    function header($title, $js=null) {
        $module = Utils::get("module", "acceuil");
        $nomUtilisateur = Utils::sessionGet("nom_utilisateur");
        $this->view->display_header($module, $title, $this->model->getUtilisateurConnecte($nomUtilisateur), $js);
    }
}