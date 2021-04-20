<?php
include_once ("./resources/module/utilisateur/ModeleUtilisateur.php");
include_once ("./resources/module/utilisateur/VueUtilisateur.php");

class ControleurUtilisateur {

    private $model;

    private $view;

    public function __construct() {

        $this->model = new ModeleUtilisateur();
        $this->view = new VueUtilisateur();
    }

    public function displayLoginPage(){
        $module = Utils::get("module", "utilisateur");
        $error = Utils::get("error");
        $nomUtilisateur = Utils::sessionGet("nom_utilisateur");
        if($nomUtilisateur != null){
            Utils::error();
        }
        $this->view->loginpage($module, $error);

    }


    public function login() {
        $nom_utilisateur = Utils::post("nom_utilisateur");
        $mot_de_passe = Utils::post("mot_de_passe");
        if($nom_utilisateur != null && $mot_de_passe != null) {
            $utilisateur = $this->model->login($nom_utilisateur, $mot_de_passe);
            if($utilisateur != false) {
                Utils::sessionSet("nom_utilisateur", $nom_utilisateur);
                header("Status: 301 Moved Permanently", false, 301);
                header("Location: ?module=utilisateur&action=monprofil");
                exit();
            }
            else {
                header("Status: 301 Moved Permanently", false, 301);
                header("Location: ?module=utilisateur&action=loginpage&error=Nom d'utilisateur et/ou mot de passe incorrect!");
                exit();
            }
        }
        else {
            header("Status: 301 Moved Permanently", false, 301);
            header("Location: ?module=utilisateur&action=loginpage&error=Veuillez renseigner nom d'utilisateur et/ou mot de passe!");
            exit();
        }
    }
}
