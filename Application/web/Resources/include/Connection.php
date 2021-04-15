<?php
/**
 * Classe de connection à la BDD
 */
class Connection
{
    /**
     * L'objet de connexion PDO
     */
    protected static $bdd;

    /**
     * Initialise la connexion
     */
    static function init(&$error = null)
    {
        try {
            self::$bdd = self::dbconnect();
            return true;
        } catch (PDOException $e) {
            $error = $e;
            return false;
        }
    }

    /**
     * Crée la connexion PDO
     */
    private static function dbconnect()
    {
        $dbconnect = self::get_dbconnect_info();
        if (is_null($dbconnect))
            throw new PDOException("Fichier de connexion invalide");

        return new PDO($dbconnect["dsn"], $dbconnect["user"], $dbconnect["pass"]);
    }

    /**
     * Récupère la configuration de la connexion BDD
     */
    private static function get_dbconnect_info()
    {

        return array(
            "dsn" => "mysql:host=db;port=3306;dbname=speedrun;charset=utf8",
            //"dsn" => "mysql:host=localhost;port=3306;dbname=speedrun;charset=utf8",
            "user" => "bipbip",
            "pass" => "grandgeocoucou"
        );
    }
}
?>