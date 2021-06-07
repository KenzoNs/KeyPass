<?php
include_once ("./resources/module/group/GroupModel.php");
include_once ("./resources/module/group/GroupModel.php");
include_once ("./resources/module/group/GroupView.php");
include_once ("./resources/include/Security.php");
include_once ("./resources/include/Controller.php");
include_once ("./resources/include/Utils.php");
include_once ("./resources/module/header/HeaderController.php");

class GroupController extends Controller {

    private $header;

    public function __construct() {
        $this->header = new HeaderController();
        parent::__construct(new GroupModel(), new GroupView());
    }

    public function createGroup() {
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['privilege_utilisateur'] == 1){
                $info = Utils::get("info");
                $this->header->header('Ajouter Groupe');
                $this->getView()->createGroupePage($info);

            }
            else{
                Utils::forceDisconnection();
            }
        }
        else{
            Utils::switchPageInfo('user', 'login', 'Vous n\'êtes pas connecté(e)');
        }
    }

    public function doCreateGroup() {
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['privilege_utilisateur'] == 1){
                if(Utils::post('group_name') != null) {
                    $group_name = Security::encrypt(Utils::post('group_name'));
                    if (!$this->getModel()->isGroupNameExist($group_name)) {

                        $this->getModel()->createGroup($group_name);

                        Utils::switchPage('home');
                    } else {
                        Utils::switchPageInfo('group', 'createGroup', 'Nom groupe déjà utilisé');
                    }
                }
                else{
                    Utils::switchPageInfo('group', 'createGroup', 'Aucun champ n\'est rempli');
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
}