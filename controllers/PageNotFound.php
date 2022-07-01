<?php
declare(strict_types=1);

namespace app\controllers;

use app\renderer\Renderer;


class PageNotFound 
{
   public static function page404(){
    $renderer = new Renderer();
    $content =$renderer-> content('./views/404.php');
    require './views/template.php';
   }

   
}
