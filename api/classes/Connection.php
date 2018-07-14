<?php
/*
Connection class create to connect to database will be called when we need to do any query to the database
*/
date_default_timezone_set("America/Mexico_City");
setlocale(LC_ALL,"es_ES");
class Connection {
    //Variables used to connect to database
    private static $dns = 'mysql:dbname=itea;host=35.165.79.206';
    private static $user = 'itea';
    private static $password = '1t34';
    
    //Static method to connect to database
    static function connect(){
        //Connection object instance
        try {
            $connection = new PDO(self::$dns, self::$user, self::$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        }
        catch (PDOException $e) {
            die('Connection error: ' . $e->getMessage());
        }
        //Return connection
        return $connection;
    }
    //Static method to disconnect
    static function disconnect($connection){
        //Close the connection received
        $connection = null;
    }
}

?>
