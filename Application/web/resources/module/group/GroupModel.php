<?php

include_once("./resources/include/Connection.php");
include_once("./resources/include/Security.php");

/**
 * Modele group
 */
class GroupModel extends Connection
{

    /**
     * Recupere la liste des noms des groupes
     */
    function getAllNameGroup()
    {
        self::connection();
        $rq = self::$bdd->prepare("SELECT nom_groupe FROM groupe");
        $rq->execute();
        self::disconnection();
        return $rq;
    }
}
