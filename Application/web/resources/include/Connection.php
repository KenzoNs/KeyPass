<?php

class Connection{

    protected static ?PDO $bdd = null;
    private static bool $isConnected = false;

    static function connection()
    {
        try {
            if (self::testIsConnected()) {
                return;
            } else {
                self::$bdd = self::createPDO();

                if(self::$bdd == null) {
                    throw new PDOException();
                }
                else{
                    self::$isConnected = true;
                    return self::$bdd;
                }
            }
        } catch (PDOException $e) {
            echo 'La connexion à la base de données a échoué';
            exit();
        }
    }

    static function disconnection(){
        if (!self::$bdd == null){
            self::$bdd = null;
            self::$isConnected = false;
        }
    }

    private static function testIsConnected(): bool{
        return self::$isConnected;
    }

    private static function createPDO(): PDO{
        $infoConnection = self::get_dbconnect_info();
        if (is_null($infoConnection)) {
            throw new PDOException();
        }
        else{
            return new PDO($infoConnection["dsn"], $infoConnection["username"], $infoConnection["password"]);
        }
    }

    private static function get_dbconnect_info(): array{
        $array = array(
            "dsn" => "mysql:host=database;port=3306;dbname=keepass;charset=utf8",
            "username" => "user",
            "password" => "password"
        );

        return $array;
    }
}
