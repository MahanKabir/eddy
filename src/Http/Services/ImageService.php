<?php

namespace Mahan\Eddy\Http\Services;

use Mahan\Eddy\Database\Connection;
use PDO;
use PDOException;

class ImageService
{
    private $server;
    private $files;

    private $allowed;
    private $filesize;
    private $filename;
    private $filetype;
    private $path;

    public function __construct($server, $files)
    {
        $this->server = $server;
        $this->files = $files;
    }

    public function fileData(){
        $this->allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $this->filesize = $this->files['image']["size"];
        $this->filename = $this->files['image']["name"];
        $this->filetype = $this->files['image']["type"];
        $this->path = '../public/storage/images/';
    }

    public function upload(){
        // Check if the form was submitted
        if($this->server["REQUEST_METHOD"] == "POST"){

            // Check if file was uploaded without errors
            if(isset($this->files['image']) && $this->files['image']["error"] == 0){
                $this->fileData();

                $this->verifyFileExtension();
                $this->verifyFileSize();
                $this->verifyFileMYME();

            } else{
                echo "Error: " . $this->files['image']["error"];
            }
        }
    }

    public function verifyFileExtension(){
        // Verify file extension
        $ext = pathinfo($this->filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $this->allowed)) die("Error: Please select a valid file format.");
    }

    public function verifyFileSize(){
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($this->filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    }

    public function verifyFileMYME(){
        // Verify MYME type of the file
        if(in_array($this->filetype, $this->allowed)){
            // Check whether file exists before uploading it
            if(file_exists($this->path . $this->filename)){
                echo $this->filename . " is already exists.";
            } else{
                // move file
                $this->moveFile();
            }
        } else{
            echo "Error: There was a problem uploading your file. Please try again.";
        }
    }

    public function moveFile(){
        move_uploaded_file($this->files['image']["tmp_name"], $this->path . $this->filename);
        echo "Your file was uploaded successfully.";
    }

    public function create(){

        $conn = new Connection();
        $conn = $conn->connect();

        $path = 'http://' . $this->server['HTTP_HOST'] . '/storage/images/' . $this->filename;

        try {
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO eddy_images (path, status) VALUES ('$path', 1)";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "New record created successfully" . "<br>";
        }
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage() . "<br>";
        }

        $conn = null;
    }

    public function all($column='*'){

        $conn = new Connection();
        $conn = $conn->connect();

        try {
            $stmt = $conn->prepare("SELECT `$column` FROM eddy_images");
            $stmt->execute();
            $images = $stmt->fetchAll();

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

        return $images;
    }
}