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
            Utils::switchPage('home');
        }
        else{
            $info = Utils::get("info");
            $this->getView()->loginPage($info);
        }
    }

    public function doLogin() {
        if(!isset($_SESSION['user'])) {
            $userId = Utils::post("user_id");
            $password = Utils::post("user_password");
            if ($userId != null && $password != null) {
                $user = $this->getModel()->login($userId, $password);
                if ($user != null) {
                    $_SESSION['user'] = $user;
                    Utils::switchPage('home');
                }
                else {
                    Utils::infoMessage('user', 'login', 'Nom d\'utilsateur et/ou mot de passe incorrect');
                }
            }
            else {
                Utils::infoMessage('user', 'login', 'Veuillez remplir tous les champs');
            }
        }
        else{
            Utils::switchPage('home');
        }
    }

    public function search(){
        if(Utils::isConnected()){
            $search_content = Utils::get("value");
            $this->getView()->search($this->getModel()->search($search_content));
        }
    }

    public function disconnection() {
        if(isset($_SESSION['user'])){
            session_unset();
            session_destroy();
            Utils::switchPage('user', 'login');
        }
        else{
            Utils::infoMessage("user", "login", "Accès refusé");
        }
    }
}
