<?php 
declare(strict_types=1);

namespace app\controllers;


class CvController{
    public function cv(){
        $file = './assets/img/cv.pdf';

        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="'.$file.'"');
        header('Content-Transfer-Encoding:binary');
        header('Accept-Ranges: bytes');
        @readfile($file);
    }
}
