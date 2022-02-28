<?php

use Mahan\Eddy\Http\Controllers\PostController;

$request = $_SERVER['REQUEST_URI'];
$query = $_SERVER['QUERY_STRING'] ?? null;

switch ($request) {
    case '/':
        $art = new PostController();
        echo $art->index();
        break;
    case '/create':
        $art = new PostController();
        echo $art->create();
        break;
    case '/store':
        $art = new PostController();
        echo $art->store();
        break;
    case '/articles' . '?' . $query:
        $art = new PostController();
        echo $art->show();
        break;
    case '/image-upload':
        $art = new PostController();
        echo $art->imageUpload();
        break;
    case '/video-upload':
        $art = new PostController();
        echo $art->videoUpload();
        break;
    case '/gallery-upload':
        $art = new PostController();
        echo $art->galleryUpload();
        break;
    case '/migrate':
        $a = new \App\Models\Article();
        echo $a->articles();
        break;

    default:
        $err = new \App\Controller\Controller();
        $err->status404();
        break;

}