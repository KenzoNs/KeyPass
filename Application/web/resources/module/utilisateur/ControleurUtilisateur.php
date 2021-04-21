<?php
include_once ("./resources/module/utilisateur/ModeleUtilisateur.php");
include_once ("./resources/module/utilisateur/VueUtilisateur.php");
include_once ("./resources/include/Security.php");

class ControleurUtilisateur {

    private $model;

    private $view;

    public function __construct() {

        $this->model = new ModeleUtilisateur();
        $this->view = new VueUtilisateur();
    }

    public function displayLoginPage(){
        $nomUtilisateur = isset($_SESSION);
        if($nomUtilisateur == null){
            $module = Utils::get("module", "utilisateur");
            $error = Utils::get("error");
            $this->view->loginPage($module, $error);
        }
        else{
            Utils::error();
        }

    }

    public function login() {
        $nom_utilisateur = Utils::post("identifiant_utilisateur");
        $mot_de_passe = Utils::post("mot_de_passe");
        if($nom_utilisateur != null && $mot_de_passe != null) {
            $nom_utilisateur = Security::encrypt($nom_utilisateur);
            $mot_de_passe = Security::encrypt($mot_de_passe);
            $utilisateur = $this->model->login($nom_utilisateur, $mot_de_passe);
            if($utilisateur != false) {
                session_start($utilisateur);
                header("Status: 301 Moved Permanently", false, 301);
                header("Location: ?module=utilisateur&action=monprofil");
                exit();
            }
            else {
                header("Status: 301 Moved Permanently", false, 301);
                header("Location: ?module=utilisateur&action=authentification&error=Nom d'utilisateur et/ou mot de passe incorrect");
                exit();
            }
        }
        else {
            header("Status: 301 Moved Permanently", false, 301);
            header("Location: ?module=utilisateur&action=authentification&error=Veuillez renseigner nom d'utilisateur et/ou mot de passe!");
            exit();
        }
    }
}
