<?php
/**
 * Classe utilitaire
 */
class Utils {

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
        return isset($_FILES[$key]) ? $_FILES[$key] : null;
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

    static function switchPage($module, $action=null){
        header("Status: 301 Moved Permanently", false, 301);
        if(isset($action)){
            header("Location: ?module=".$module."&action=".$action."");
        }
        else{
            header("Location: ?module=".$module."");
        }
        exit();
    }

    static function switchPageInfo($module, $action, $info){
        header("Status: 301 Moved Permanently", false, 301);
        header("Location: ?module=".$module."&action=".$action."&info=".$info."");
        exit();
    }


    static function forceDisconnection(){
        if (isset($_SESSION['user'])) {
            session_unset();
            session_destroy();
            Utils::switchPageInfo('user', 'login', "Accès refusé");

        }
        else{
            Utils::switchPageInfo("user", "login", "Impossible vous n'êtes pas connecté(e)");
        }
    }
}
