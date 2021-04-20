<?php
class AlreadyConnected extends Exception
{
    public function __construct($code = 0)
    {
        parent::__construct("Connexion à la base de données déjà établie<br>", $code);
    }

    public function __toString()
    {
        return $this->message;
    }
}