<?php
require_once __DIR__ . '/../core/init.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

date_default_timezone_set('America/Toronto');

class TatoTest extends TestCase
{
    public function testPostTato(){
        global $getTatoManager;

        $this->assertTrue(
            $getTatoManager->postTato(9,'phpunit test posting a tato',NULL)
        );
    }

    //effort to make image test work
//    public function testPostImage(){
//        global $getTatoManager;
//        $path = '/home/yuxiang/Documents/html/uc3/assets/images/';
//        $uploaddir = '/var/www/uploads/';
//        $uploadfile = $path . basename($_FILES['montreal.jpg']['tmp_name']);
//        move_uploaded_file($_FILES['montreal.jpg']['tmp_name'], $uploadfile);
//        $this->assertTrue(
//            $getTatoManager->postTato(9,'',$_FILES['montreal.jpg']['tmp_name'])
//        );
//
//
//    }

    public function testPostPic(){
        global $getTatoManager;

        $this->assertTrue(
            $getTatoManager->postPic(174)
        );
    }

}