<?php
session_start();
/* DATABASE CONFIGURATION */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'bos_user');
define('DB_PASSWORD', 'fgKk{r{N&C_v');
define('DB_DATABASE', 'bos_booking');
define("BASE_URL", "http://bos.cr/");
define('DB_CHARSET','utf-8');
class conect{
    public static function conection(){

        try{
            $conection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
            $conection->set_charset(DB_CHARSET);

        }catch (Exception $e){
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $conection;
    }
}





function getDB(){
    $dbhost=DB_SERVER;
    $dbuser=DB_USERNAME;
    $dbpass=DB_PASSWORD;
    $dbname=DB_DATABASE;
    try{
        $dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $dbConnection->exec("set names utf8");
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
    catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    return false;
}

?>