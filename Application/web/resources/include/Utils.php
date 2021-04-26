<?php
/**
 * Classe utilitaire
 */
include_once ("./resources/include/Url.php");
class Utils {

    /**
     * Récupere une variable $_GET si définie, sinon la valeur par défaut
     */
    static function get($val, $def=null) {
        if ($_GET[$val] == null){
            return $def;
        }
        return $_GET[$val];
    }

    /**
     * Récupere une liste de variable $_GET
     * si tableau indexé => les valeurs sont les variables à récupérer
     * si tableau associatif => les clés sont les variables à récupérer, les valeurs par défaut
     */
    static function getMany($vals): array
    {
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
        return $_POST[$val] ?? $def;
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
     * Récupere un variable $_SESSION si définie, sinon la valeur par défaut
     */
    static function sessionGet($val, $def=null) {
        return $_SESSION[$val] ?? $def;
    }

    /**
     * Récupere une liste de variable $_SESSION
     * si tableau indexé => les valeurs sont les variables à récupérer
     * si tableau associatif => les clés sont les variables à récupérer, les valeurs les valeurs par défaut
     */
    static function sessionGetMany($vals): array
    {
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
        return $_FILES[$key] ?? null;
    }

    /**
     * Charge un module
     * si module non précisé, deuxième chance pour récupérer la variable $_GET
     * si module demandé non déclaré ==> erreur HTTP 404
     */

    static function error($code=404, $status="Not Found") {
        http_response_code($code);
        echo "<pre>$code $status</pre>";
        die;
    }

    static function isConnected(): bool
    {
        return isset($_SESSION["nomUtilisateur"]);
    }

    static function deconnection(){
        $_SESSION["nomUtilisateur"] == null;
    }


}
