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

    public function sendEmail(){
        if (!isset($_SESSION['user'])){
            $error = Utils::get("error");
            $this->getView()->sendEmailPage($error);
        }
        else{
            Utils::switchPage('home');
        }
    }

    public function doSendEmail(){
        if (!isset($_SESSION['user'])){
            $userEmail = Utils::post("user_mail");
            if(isset($userEmail)){
                $user = $this->getModel()->isUserEmailExist($userEmail);
                if($user){
                    if($this->createAndSendMail($user)){
                        Utils::infoMessage('user', 'login', 'Un email vous a été envoyé');
                    }
                    Utils::infoMessage('user', 'login', 'Erreur envoie email');
                }
                else{
                    Utils::infoMessage('user', 'sendEmail', 'Cet email n\'existe pas');
                }
            }
            else{
                Utils::infoMessage('user', 'sendEmail', 'Veuillez renseigner votre email');
            }
        }
        else{
            Utils::switchPage('home');
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


    public function createAndSendMail($user){
        $objet = 'Nouveau mot de passe';
        $to = $user['email'];

        $header = "From: KeePass <no-reply@test.com> \n";
        $header .= "Reply-To: ".$to."\n";
        $header .= "MIME-version: 1.0\n";
        $header .= "Content-Transfer-Encoding: 8bit";

        $contenu ="<html>".
        "<body>".
        "<p style='text-align: center; font-size: 18px'><b>Bonjour Mr, Mme" .$user['nom']." ".$user['prenom']."</b>,</p><br/>".
        "<p style='text-align: justify'><i><b>Nouveau mot de passe : </b></i>".Utils::genCode()."</p><br/>".
        "</body>".
        "</html>";

        return mail($to, $objet, $contenu, $header);
    }
}
