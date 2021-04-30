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

    static function isConnected(): bool
    {
        return isset($_SESSION["user"]);
    }

    static function deconnection(){
        $_SESSION["user"] == null;
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

    static function infoMessage($module, $action, $info){
        header("Status: 301 Moved Permanently", false, 301);
        header("Location: ?module=".$module."&action=".$action."&info=".$info."");
        exit();
    }

    static function genCode(){
        $haz=array
        (1,
            rand(2,3),
            rand(4,5),
            rand(6,7),
            rand(8,9),0
        );

        shuffle($haz);
        $co="";
        $i=0;

        while($i<6){
            $co.= $haz[$i];
            if(!in_array($co,$haz)){
            }else{}
            $i++;
        }
        return $co;
    }


}
