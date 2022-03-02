<?php


namespace Mahan\Eddy\Http\Models;

use Jenssegers\Blade\Blade;

class Migration
{
    public function tables(){
        echo (new Post())->posts();
        echo (new Image())->images();
    }
}