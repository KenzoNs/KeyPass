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
                        $_SESSION['cuser_mat'] = Utils::post('user_mat');
                        $_SESSION['cuser_fname'] = Utils::post('user_fname');
                        $_SESSION['cuser_name'] = Utils::post('user_name');
                        $_SESSION['cuser_identifiant'] = Utils::post('user_identifiant');
                        $_SESSION['cuser_rank'] = Utils::post('user_rank');
                        $_SESSION['cuser_function'] = Utils::post('user_function');
                        if(Utils::post('user_pass1') == Utils::post('user_pass2')){
                            $_SESSION['cuser_pass'] = Utils::post('user_pass1');
                            if(Utils::post('user_mail')!= null){
                                if(!preg_match("/@ght-gpne\.fr$/", Utils::post('user_mail'))){
                                    Utils::switchPageInfo('user', 'createUser', 'Le format de l\'adresse mail invalide');
                                }
                                $_SESSION['cuser_mail'] = Utils::post('user_mail');
                            }

                            if(Utils::post('user_phone')!= null){
                                if(!preg_match("/([0-9]){4}/", Utils::post('user_phone'))){
                                    Utils::switchPageInfo('user', 'createUser', 'Le format du numéro de téléphone est invalide');
                                }
                                $_SESSION['cuser_phone'] = Utils::post('user_phone');
                            }

                            if(Utils::post('user_bip')!= null){
                                if(!preg_match("/([0-9]){3}/", Utils::post('user_bip'))){
                                    Utils::switchPageInfo('user', 'createUser', 'Le format du bip est invalide');
                                }
                                $_SESSION['cuser_bip'] = Utils::post('user_nip');
                            }

                            if(Utils::post('user_edated')!= null && Utils::post('user_edatem')!= null && Utils::post('user_edatey')!= null){
                                if(checkdate(Utils::post('user_edatem'),Utils::post('user_edated'),Utils::post('user_edatey'))){

                                    $edate=date_create(Utils::post('user_edatey'). '-' .Utils::post('user_edatem'). '-' .Utils::post('user_edated'));
                                    if(Utils::post('user_odated')!= null && Utils::post('user_odatem')!= null && Utils::post('user_odatey')!= null) {
                                        if (checkdate(Utils::post('user_odatem'), Utils::post('user_odated'), Utils::post('user_odatey'))) {
                                            $odate = date_create(Utils::post('user_odatey'). '-' .Utils::post('user_odatem'). '-' .Utils::post('user_odated'));
                                            if ($edate > $odate) {
                                                Utils::switchPageInfo('user', 'createUser', 'Date de sortie supérieure à date d\'entrée');
                                            }
                                        } else {
                                            Utils::switchPageInfo('user', 'createUser', 'le format de la date de sortie est dinvalide');
                                        }
                                    }
                                }
                                else{
                                    Utils::switchPageInfo('user', 'createUser', 'le format de la date d\'entrée est vinvalide');
                                }
                            }


                            unset($_SESSION['cuser_mat']);
                            unset( $_SESSION['cuser_fname']);
                            unset($_SESSION['cuser_name']);
                            unset($_SESSION['cuser_identifiant']);
                            unset($_SESSION['cuser_rank']);
                            unset($_SESSION['cuser_function']);
                            unset($_SESSION['cuser_mail']);
                            unset($_SESSION['cuser_pass']);
                            unset($_SESSION['cuser_phone']);
                            unset($_SESSION['cuser_bip']);

                            $this->getModel()->insert(Security::encrypt(Utils::post('user_mat')), Security::encrypt(Utils::post('user_identifiant')), Security::encrypt(Utils::post('user_fname')), Security::encrypt(Utils::post('user_name')),
                                Security::encrypt(Utils::post('user_rank')), Security::encrypt(Utils::post('user_function')), Security::encrypt(Utils::post('user_group')), Utils::post('user_power'), Security::encrypt(Utils::post('user_name')),
                                Security::encrypt(Utils::post('user_mail')), Security::encrypt(Utils::post('user_phone')), Security::encrypt(Utils::post('user_bip')));

                            Utils::switchPage('home');


                        }
                        else{
                            Utils::switchPageInfo('user', 'createUser', 'Les mots de passes de correspondent pas');
                        }
                    }
                    else{
                        Utils::switchPageInfo('user', 'createUser', 'Le format du matricule est incorrect');
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
