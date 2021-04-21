<?php

class Security{

    private static $key = "Super_SECRET#KeY!";
    private static $ciphering = "AES-128-CTR";
    private static $options = 0;
    private static $iv = '1234567891011121';


    static function encrypt($string){
        return openssl_encrypt($string, self::$ciphering, self::$key, self::$options, self::$iv);
    }

    static function decrypt($string){
        return openssl_decrypt($string, self::$ciphering, self::$key, self::$options, self::$iv);
    }

}
