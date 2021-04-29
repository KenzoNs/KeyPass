<?php
include_once ("./resources/module/user/UserModel.php");
include_once ("./resources/module/user/UserView.php");
include_once ("./resources/include/Security.php");
include_once ("./resources/include/Controller.php");
include_once ("./resources/include/Utils.php");
include_once ("./resources/module/header/HeaderController.php");

class UserController extends Controller {

    private $header;

    public function __construct() {
        $this->header = new HeaderController();
        parent::__construct(new UserModel(), new UserView());
    }

    public function login(){
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
        $userId = Utils::post("user_id");
        $password = Utils::post("user_password");
        if($userId != null && $password != null) {
            $userId = Security::encrypt($userId);
            $password = Security::encrypt($password);
            $user= $this->getModel()->login($userId, $password);
            if($user != null) {

                $_SESSION['user'] = $user;
                header("Status: 301 Moved Permanently", false, 301);
                header("Location: ?module=home");
                exit();
            }
            else {
                header("Status: 301 Moved Permanently", false, 301);
                header("Location: ?module=user&action=login&error=Nom d'utilisateur et/ou mot de passe incorrect!");
                exit();
            }
        }
        else {
            header("Status: 301 Moved Permanently", false, 301);
            header("Location: ?module=user&action=login&error=Veuillez renseigner nom d'utilisateur et/ou mot de passe!");
            exit();
        }
    }

    public function disconnection() {
        if(isset($_SESSION['user'])){
            session_unset();
            session_destroy();
            header("Status: 301 Moved Permanently", false, 301);
            header("Location: ?module=user&action=login");
            exit();
        }
        else{
            header("Status: 301 Moved Permanently", false, 301);
            header("Location: ?module=user&action=login&error=Accès refusé");
            exit();
        }


        $userId = Utils::post("user_id");
        $password = Utils::post("user_password");
        if($userId != null && $password != null) {
            $userId = Security::encrypt($userId);
            $password = Security::encrypt($password);
            $user= $this->getModel()->login($userId, $password);
            if($user != null) {

                $_SESSION['user'] = $user;
                header("Status: 301 Moved Permanently", false, 301);
                header("Location: ?module=home");
                exit();
            }
            else {
                header("Status: 301 Moved Permanently", false, 301);
                header("Location: ?module=user&action=login&error=Nom d'utilisateur et/ou mot de passe incorrect!");
                exit();
            }
        }
        else {
            header("Status: 301 Moved Permanently", false, 301);
            header("Location: ?module=user&action=login&error=Veuillez renseigner nom d'utilisateur et/ou mot de passe!");
            exit();
        }
    }
}
