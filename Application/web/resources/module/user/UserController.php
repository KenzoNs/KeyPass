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
        if (isset($_SESSION['user'])){
            header("Status: 301 Moved Permanently", false, 301);
            header("Location: ?module=home");
        }
        else{
            $error = Utils::get("error");
            $this->getView()->loginPage($error);
        }
    }

    public function doLogin() {
        $nom_utilisateur = Utils::post("identifiant_utilisateur");
        $mot_de_passe = Utils::post("mot_de_passe");
        if($nom_utilisateur != null && $mot_de_passe != null) {
            $nom_utilisateur = Security::encrypt($nom_utilisateur);
            $mot_de_passe = Security::encrypt($mot_de_passe);
            $utilisateur = $this->getModel()->login($nom_utilisateur, $mot_de_passe);
            if($utilisateur != null) {

                $_SESSION['user'] = $utilisateur;
                header("Status: 301 Moved Permanently", false, 301);
                header("Location: ?module=user&action=loginPage");
                exit();
            }
            else {
                header("Status: 301 Moved Permanently", false, 301);
                header("Location: ?module=user&action=loginPage&error=Nom d'utilisateur et/ou mot de passe incorrect!");
                exit();
            }
        }
        else {
            header("Status: 301 Moved Permanently", false, 301);
            header("Location: ?module=user&action=loginPage&error=Veuillez renseigner nom d'utilisateur et/ou mot de passe!");
            exit();
        }
    }
}
