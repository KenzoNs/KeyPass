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
                    Utils::switchPageInfo('user', 'login', 'Nom d\'utilsateur et/ou mot de passe incorrect');
                }
            }
            else {
                Utils::switchPageInfo('user', 'login', 'Veuillez remplir tous les champs');
            }
        }
        else{
            Utils::switchPage('home');
        }
    }

    public function search(){
        if(isset($_SESSION['user'])){
            $search_content = Utils::get("value");
            $this->getView()->search($this->getModel()->search(strtolower($search_content)));
        }
        else{
            Utils::disconnection();
        }
    }

    public function createUser() {
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['privilege_utilisateur'] == 1){


                //TODO
            }
            else{
                Utils::disconnection("true");
            }
        }
        else{
            Utils::disconnection();
        }
    }

    public function doCreateUser() {
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['privilege_utilisateur'] == 1){


                //TODO
            }
            else{
                Utils::disconnection("true");
            }
        }
        else{
            Utils::switchPageInfo('user', 'login', 'Vous n\'êtes pas connecté(e)');
        }
    }
}
