<?php
include_once __DIR__ . "/Connection.php";

/**
 * Classe utilitaire
 */
class Utils {
    private static $isConnectionInit = false;

    /**
     * Tableau des modules
     */
    public static $modules = array(
        "admin" => "ModAdmin",
        "acceuil" => "ModAcceuil",
        "utilisateur" => "ModUtilisateur",
        "jeu" => "ModJeu",
        "categorie" => "ModCategorie",
        "evenement" => "ModEvenement",
        "video" => "ModVideo"
    );

    /**
     * Récupere une variable $_GET si définie, sinon la valeur par défaut
     */
    static function get($val, $def=null) {
        return isset($_GET[$val]) ? $_GET[$val] : $def;
    }

    /**
     * Récupere une liste de variable $_GET
     * si tableau indexé => les valeurs sont les variables à récupérer
     * si tableau associatif => les clés sont les variables à récupérer, les valeurs par défaut
     */
    static function getMany($vals) {
        $values = array();
        foreach ($vals as $val => $def) {
            if (is_int($val))
                $values[] = self::get($def);
            else
                $values[] = self::get($val, $def);
        }
        return $values;
    }

    /**
     * Récupere une variable $_POST si définie, sinon la valeur par défaut
     */
    static function post($val, $def=null) {
        return isset($_POST[$val]) ? $_POST[$val] : $def;
    }

    /**
     * Récupere une liste de variable $_POST
     * si tableau indexé => les valeurs sont les variables à récupérer
     * si tableau associatif => les clés sont les variables à récupérer, les valeurs les valeurs par défaut
     */
    static function postMany($vals) {
        $values = array();
        foreach ($vals as $val => $def) {
            if (is_int($val))
                $values[] = self::post($def);
            else
                $values[] = self::post($val, $def);
        }
        return $values;
    }

    /**
     * Définit un variable $_SESSION
     */
    static function sessionSet($key, $val) {
        $_SESSION[$key] = $val;
    }

    /**
     * Récupere un variable $_SESSION si définie, sinon la valeur par défaut
     */
    static function sessionGet($val, $def=null) {
        return isset($_SESSION[$val]) ? $_SESSION[$val] : $def;
    }

    /**
     * Récupere une liste de variable $_SESSION
     * si tableau indexé => les valeurs sont les variables à récupérer
     * si tableau associatif => les clés sont les variables à récupérer, les valeurs les valeurs par défaut
     */
    static function sessionGetMany($vals) {
        $values = array();
        foreach ($vals as $val => $def) {
            if (is_int($val))
                $values[] = self::sessionGet($def);
            else
                $values[] = self::sessionGet($val, $def);
        }
        return $values;
    }

    /**
     * Récupere un variable $_FILES si définie
     */
    static function fileGet($key) {
        return isset($_FILES[$key]) ? $_FILES[$key] : null;
    }

    /**
     * Charge un module
     * si module non précisé, deuxième chance pour récupérer la variable $_GET
     * si module demandé non déclaré ==> erreur HTTP 404
     */
    static function loadModule($mod=null) {
        if (is_null($mod))
            $mod = self::get("module");

        if (is_null($mod) || !array_key_exists($mod, self::$modules))
            self::error();

        include_once "module/mod_$mod/mod_$mod.php";
        self::initConnection();
        return new self::$modules[$mod]();
    }

    /**
     * Initialise la connexion BDD
     * (si elle n'est pas déja initialisée)
     */
    static function initConnection() {
        if (self::$isConnectionInit)
            return;

        if (!Connection::init($e)) {
            echo $e;
            Utils::error(500, "Internal Server Error");
        }
        self::$isConnectionInit = true;
    }

    /**
     * Génére une erreur HTTP et meurt
     */
    static function error($code=404, $status="Not Found") {
        http_response_code($code);
        echo "<pre>$code $status</pre>";
        die;
    }
}
?>