<?php

class Database {

    protected function connect() {
        try {

            $servername = "mysql";
            $username = "v.je";
            $password = "v.je";
            $db = "praktyki";

            $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            return $conn;

        } catch (PDOException $e) {

            print "Error! " . $e->getMessage() . "<br>";
            die();

        }
        
    }
}