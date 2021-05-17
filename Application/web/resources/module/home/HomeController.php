<?php
include_once ("./resources/module/home/HomeModel.php");
include_once ("./resources/module/header/HeaderController.php");
include_once ("./resources/module/home/HomeView.php");
include_once ("./resources/include/Security.php");
include_once ("./resources/include/Controller.php");
include_once ("./resources/include/Utils.php");

class HomeController extends Controller {

    private $header;

    public function __construct() {
        $this->header = new HeaderController();
        parent::__construct(new HomeModel(), new HomeView());
    }

    public function home(){
        if (isset($_SESSION['user'])){
            $this->header->homeHeader('Accueil');
            $this->getView()->homePage();
        }
        else{
            Utils::switchPageInfo('user', 'login', 'Vous n\'êtes pas connecté(e)');
        }
    }

    public function chooseAction(){
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['privilege_utilisateur']){
                $this->header->header('Sélectionner');
                $this->getView()->chooseActionPage();
            }
            else{
                Utils::disconnection('true');
            }
        }
        else{
            Utils::switchPageInfo('user', 'login', 'Vous n\'êtes pas connecté(e)');
        }
    }

}

