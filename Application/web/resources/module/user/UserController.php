<?php
include_once ("./resources/module/user/UserModel.php");
include_once ("./resources/module/group/GroupModel.php");
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
            Utils::switchPageInfo('user', 'login', 'Vous n\'êtes pas connecté(e)');
        }
    }

    public function createUser() {
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['privilege_utilisateur'] == 1){
                $groupModel = new GroupModel();
                $info = Utils::get("info");
                $this->header->header('Ajouter Utilisateur');

                $this->getView()->createUserPage($groupModel->getAllNameGroup(), $info);


            }
            else{
                Utils::forceDisconnection();
            }
        }
        else{
            Utils::switchPageInfo('user', 'login', 'Vous n\'êtes pas connecté(e)');
        }
    }

    public function doCreateUser() {
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['privilege_utilisateur'] == 1){
                if(Utils::post('user_mat') != null ){
                    if(preg_match("/w([0-9]){6}/i", Utils::post('user_mat'))){
                        Utils::switchPageInfo('user', 'createUser', 'Ok');
                    }
                }
                else{
                    Utils::switchPageInfo('user', 'createUser', 'Veuillez remplir tous les champs obligatoires');
                }
            }
            else{
                Utils::forceDisconnection();
            }
        }
        else{
            Utils::switchPageInfo('user', 'login', 'Vous n\'êtes pas connecté(e)');
        }
    }

    public function disconnection() {
        if(isset($_SESSION['user'])){
            session_unset();
            session_destroy();

            Utils::switchPage("user", "login");

        }
        else{
            Utils::switchPageInfo("user", "login", "Impossible vous n'êtes pas connecté(e)");
        }
    }
}
