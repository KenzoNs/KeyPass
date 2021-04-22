<?php

abstract class Controler {

    private $model;

    private $view;

    public function __construct($model, $view) {

        $this->model = new $model;
        $this->view = new $view;
    }

    public function getModel(){
        return $this->model;
    }

    public function getView(){
        return $this->model;
    }


}
