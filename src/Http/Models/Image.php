<?php


namespace Mahan\Eddy\Http\Models;


use Mahan\Eddy\Database\Connection;

class Image
{
    public function images(){

        $conn = new Connection();
        $conn = $conn->connect();

        $table = 'eddy_images';
        try {
            // sql to create table
            $sql = 'CREATE TABLE '.$table.'(
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                    path VARCHAR(4095) NULL,
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