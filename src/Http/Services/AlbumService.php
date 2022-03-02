<?php


namespace Mahan\Eddy\Http\Services;


class AlbumService
{
    private $files;
    private $path;

    public function __construct($files)
    {
        $this->files = $files;
    }

    public function fileData(){

        $this->path = '../public/storage/albums/';
    }

    public function upload(){

        $this->fileData();

        extract($this->files);
        $error = array();
        $extension = array("jpeg","jpg","png","gif");
        foreach($this->files["album"]["tmp_name"] as $key=>$tmp_name) {

            $file_name = $this->files["album"]["name"][$key];
            $file_tmp = $this->files["album"]["tmp_name"][$key];
            $ext=pathinfo($file_name,PATHINFO_EXTENSION);

            if(in_array($ext,$extension)) {
                if(!file_exists($this->path . $file_name)) {
                    move_uploaded_file($file_tmp=$this->files["album"]["tmp_name"][$key], $this->path . $file_name);
                }
                else {
                    echo $file_name . " is already exists." . "<br>";
                }
            }
            else {
                array_push($error,"$file_name, ");
            }
        }
    }
}