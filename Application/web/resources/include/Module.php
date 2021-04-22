<?php
include_once ("./resources/include/ModuleManager.php");
include_once ("./resources/include/Controler.php");

abstract class Module {

    private Controler $controler;
    private array $actions;

    public function __construct(Controler $controler, array $actions){

        $this->controler = $controler;
        $this->actions = $actions;

    }

    public function getControler(): Controler
    {
        return $this->controler;
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    public function isActionExist($action): bool
    {
        if(in_array($action, $this->actions)){
            return true;
        }
        return false;
    }

    public function switchPage($action){
        if($this::isActionExist($action)){
            header("Status: 301 Moved Permanently", true, 301);
            header("Location: ?module=".ModuleManager::getModule()."&action=".$action."");
            $this->controler->$action();
        }
        Utils::error();
    }

}
