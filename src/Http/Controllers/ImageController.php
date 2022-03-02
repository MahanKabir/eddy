<?php


namespace Mahan\Eddy\Http\Controllers;

use Mahan\Eddy\Http\Services\ImageService;

class ImageController
{

    public function imageUpload(){
        $service = new ImageService($_SERVER, $_FILES, 'image');
        $service->upload();
        $service->create();
    }

    public function getImages(){

        $service = new ImageService($_SERVER, $_FILES);
        $images = $service->all('path');
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($images);
    }
}