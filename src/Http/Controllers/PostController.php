<?php

namespace Mahan\Eddy\Http\Controllers;

use http\Env\Response;
use Mahan\Eddy\Database\Connection;
use Mahan\Eddy\Http\Services\PostService;
use Mahan\Eddy\Http\Services\AlbumService;
use Mahan\Eddy\Http\Services\ImageService;
use Mahan\Eddy\Http\Services\VideoService;

use Jenssegers\Blade\Blade;
use PDOException;

class PostController
{
    public function index(){

        $conn = new Connection();
        $conn = $conn->connect();

        try {
            $stmt = $conn->prepare("SELECT `section` FROM eddy_posts GROUP BY `section`");
            $stmt->execute();

            $posts = $stmt->fetchAll();

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

        $blade = new Blade('../vendor/mahan/eddy/src/Resources/Views', '../public/storage/cache/views/');
        return $blade->make('post.index', compact('posts'))->render();
    }

    public function create(){
        $blade = new Blade('../vendor/mahan/eddy/src/Resources/Views', '../public/storage/cache/views/');
        return $blade->make('index')->render();
    }

    public function store($section=null){

        $rows = $_POST['data'];

        $rows = json_decode($rows);

        if (is_null($section)){
            $section = rand(10000, 99999);
        }else{
            unset($rows[0]);
        }

        $service = new PostService();

        foreach ($rows as $row){
            $service->create($row, $section);
        }
    }

    public function edit(){
        $section = $_GET['section'];

        $service = new PostService();
        $posts = $service->where($section);

        $blade = new Blade('../vendor/mahan/eddy/src/Resources/Views', '../public/storage/cache/views/');
        return $blade->make('post.edit', compact('posts', 'section'))->render();
    }

    public function update(){

        $section = (int)json_decode($_POST['data'])[0]->section;

        $service = new PostService();
        $service->delete($section);

        $this->store($section);
    }

    public function show(){

        $section = $_GET['section'];

        $conn = new Connection();
        $conn = $conn->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM eddy_posts where `section`='$section'");
            $stmt->execute();
            $posts = $stmt->fetchAll();

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

        $blade = new Blade('../vendor/mahan/eddy/src/Resources/Views', '../public/storage/cache/views/');
        return $blade->make('post.show', compact('posts'))->render();
    }

    public function delete(){

        $rows = $_POST['data'];

        $rows = json_decode($rows);
        $random = rand(10000, 99999);
        $service = new PostService();

        foreach ($rows as $row){
            $service->create($row, $random);
        }
    }

    public function videoUpload(){

        $service = new VideoService($_FILES);
        $service->upload();
    }

    public function galleryUpload(){
        $service = new AlbumService($_FILES);
        $service->upload();

    }

    public function getImages(){

        $service = new PostService();
        $posts = $service->all('path');

        $pathes = array();

        foreach ($posts as $post){
            array_push($pathes, $post['path']);
        }

        $images = array();

        foreach($pathes as $index=>$path){
            $images = array_merge($images, json_decode($path));
        }

        header('Content-Type: application/json; charset=utf-8');
        return json_encode($images);
    }
}