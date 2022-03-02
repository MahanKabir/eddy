<?php


namespace Mahan\Eddy\Http\Controllers;

use Mahan\Eddy\Database\Connection;
use Jenssegers\Blade\Blade;

class Controller
{
    public function status404(){

        $blade = new Blade('../views', 'cache');
        return $blade->make('errors.status404')->render();
    }
}