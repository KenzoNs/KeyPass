<?php
class NotConnectedException extends Exception{
    public function __construct($code = 0){
        parent::__construct("Vous n'êtes pas connecté à la base de données<br>", $code);
    }

    public function __toString(){
        return $this->message;
    }
}

