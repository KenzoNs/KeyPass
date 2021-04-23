<?php
include_once ("./resources/include/ModuleManager.php");
include_once ("./resources/include/Controller.php");
include_once ("./resources/include/Utils.php");
include_once ("./resources/include/Url.php");

class Module {

    private String $name;
    private Controller $controller;
    private array $actions;

    public function __construct(String $name, Controller $controller, array $actions){

        $this->name = $name;
        $this->controller = $controller;
        $this->actions = $actions;

    }

    public function getName(){
        return $this->name;
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    public function isActionExist($action): bool
    {
        return array_key_exists($action);
    }

    public function switchPage($action){
        if($this->isActionExist($action)){
            Url::setActionUrl($action);
            Url::updateUrl();
            $this->controller->$action();
        }
        Utils::error(32, 'gfdgdf');
    }
}
