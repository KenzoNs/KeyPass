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

    public function homePage(){
        if (isset($_SESSION['user'])){
            $this->header->header('Accueil');
            $this->getView()->homePage();
        }
        else{

            header("Status: 301 Moved Permanently", false, 301);
            header("Location: ?module=user&action=login");
        }
    }

}
