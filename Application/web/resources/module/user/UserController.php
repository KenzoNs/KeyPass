<?php
include_once ("./resources/module/user/UserModel.php");
include_once ("./resources/module/user/UserView.php");
include_once ("./resources/include/Security.php");
include_once ("./resources/include/Controller.php");
include_once ("./resources/include/Utils.php");

class UserController extends Controller {


    public function __construct() {
        parent::__construct(new UserModel(), new UserView());
    }

    public function loginPage(){
        $module = ModuleManager::getCurrentModule();
        $error = Utils::post("error");
        $this->getView()->loginPage($module, $error);
    }

    public function login() {
        $nom_utilisateur = Utils::post("identifiant_utilisateur");
        $mot_de_passe = Utils::post("mot_de_passe");
        if($nom_utilisateur != null && $mot_de_passe != null) {
            $nom_utilisateur = Security::encrypt($nom_utilisateur);
            $mot_de_passe = Security::encrypt($mot_de_passe);
            $utilisateur = $this->getModel()->login($nom_utilisateur, $mot_de_passe);
            if($utilisateur != null) {
                session_start($utilisateur);
                exit();
            }
            else {
                exit();
            }
        }
        else {
            exit();
        }
    }
}
