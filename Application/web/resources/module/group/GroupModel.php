<?php

include_once("./resources/include/Connection.php");
include_once("./resources/include/Security.php");

/**
 * Modele group
 */
class GroupModel extends Connection
{
    function isGroupNameExist($name) {
        self::connection();
        $query = self::$bdd->prepare("SELECT nom_groupe FROM groupe WHERE nom_groupe = :group");
        $query->execute(array("group" => $name));
        self::disconnection();
        return $query->fetch(PDO::FETCH_ASSOC);
    }



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

    function createGroup($nameGroup)
    {
        self::connection();
        $query = self::$bdd->prepare("INSERT INTO groupe (nom_groupe)".
            "VALUES (:nomGroupe)");
        $query->execute(array(":nomGroupe" => $nameGroup));
        self::disconnection();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

}
