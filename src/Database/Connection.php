<?php

namespace Mahan\Eddy\Database;

use PDO;
use PDOException;

class Connection
{

    public function connect(){

        $servername = "localhost";
        $username = "mahan";
        $password = "155180";
        $database = "db_editor";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage() . "\n";
        }

        return $conn;
    }
}