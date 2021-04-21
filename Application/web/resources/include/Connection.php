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
        } catch (AlreadyConnected $e) {
            echo $e;
        }
    }

    /**
     * @throws NotConnectedException
     */
    static function deconnection()
    {
        if (self::$bdd == null){
            throw new NotConnectedException();
        }
        else{
            self::$bdd = null;
            self::$isConnected = false;
        }
    }

    private static function testIsConnected(): bool
    {
        if(self::$isConnected){
            throw new AlreadyConnected();
        }
        return self::$isConnected;
    }

    private static function createPDO(): PDO
    {
        $infoConnection = self::get_dbconnect_info();
        if (is_null($infoConnection)) {
            throw new DataBaseConnectionException();
        }
        else{
            return new PDO($infoConnection["dsn"], $infoConnection["username"], $infoConnection["password"]);
        }
    }

    private static function get_dbconnect_info(): array
    {
        $array = array(
            "dsn" => "mysql:host=database;port=3306;dbname=keypass;charset=utf8",
            "username" => "user",
            "password" => "password"
        );

        return $array;
    }
}
