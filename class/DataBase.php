<?php
class Database {
    public function getConn() {
        $db_host = "localhost";
        $db_name = "zametki";
        $db_user = "leviathan";
        $db_pass = "nekitos31";
        
        $dsn = "mysql:host" . $db_host . ";dbname=" . $db_name . ";charser=utf8";



        try{
            $db = new PDO($dsn, $db_user, $db_pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }catch(PDOException $e) {
            exit;
        }
        
    }
}

