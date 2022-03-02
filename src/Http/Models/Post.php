<?php

namespace Mahan\Eddy\Http\Models;

use Mahan\Eddy\Database\Connection;
use PDOException;

class Post
{
    public function posts(){

        $conn = new Connection();
        $conn = $conn->connect();

        $table = 'eddy_posts';
        try {
            // sql to create table
            $sql = 'CREATE TABLE '.$table.'(
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                    type VARCHAR(255) NULL,
                    value VARCHAR(2047) NULL,
                    path VARCHAR(4095) NULL,
                    section INT NOT NULL,
                    status INT(1) DEFAULT 1 NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL
                    )';

            // use exec() because no results are returned
            $conn->exec($sql);
        }
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

        $conn = null;
    }
}