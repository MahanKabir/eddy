<?php

namespace Mahan\Eddy\Http\Services;

use Mahan\Eddy\Database\Connection;
use PDO;
use PDOException;

class PostService
{

    public function create($row, $random){

        $conn = new Connection();
        $conn = $conn->connect();

        $path = json_encode($row->path, JSON_UNESCAPED_UNICODE);
        $value = json_encode($row->value, JSON_UNESCAPED_UNICODE);

        try {
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO posts (type, value, path, section, status) VALUES ('$row->type', '$value', '$path', '$random',1)";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "New record created successfully" . "<br>";
        }
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage() . "<br>";
        }

        $conn = null;
    }

    public function where($section){

        $conn = new Connection();
        $conn = $conn->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM posts where `section`='$section'");
            $stmt->execute();
            $posts = $stmt->fetchAll();

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

        return $posts;
    }

    public function update($row){

    }

    public function delete($section){

        $conn = new Connection();
        $conn = $conn->connect();

        try {
            // sql to delete a record
            $stmt = $conn->prepare("DELETE FROM posts where `section`='$section'");

            // use exec() because no results are returned
            $stmt->execute();
            echo "Record deleted successfully";
        } catch(PDOException $e) {
            echo $stmt . "<br>" . $e->getMessage();
        }

        $conn = null;
    }
}