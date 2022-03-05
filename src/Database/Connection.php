<?php

namespace Mahan\Eddy\Database;

use Mahan\Eddy\Config\Env;
use PDO;
use PDOException;

class Connection
{

    public function connect(){

        (new Env(__DIR__ . '/.env'))->load();

        echo getenv('APP_ENV');
        // dev
        echo getenv('DATABASE_DNS');die;
        // mysql:host=localhost;dbname=test;



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