<?php
//require __DIR__ . '/../includes/liketato.php';
////require('vendor/autoload.php');
//
//use PHPUnit\Framework\TestCase;
//
//class LikeTatoTest extends TestCase
//{
//    protected $client;
//
//    protected function setUp() {
//        $this->client = new GuzzleHttp\Client([
//            'base_uri' =>"https://travis-ci.com/"
//        ]);
//    }
//
//    public function testValidLikeRequest() {
//        $response = $this->client->request('POST', '/LouisBenjamin/UC3-Team-Project/includes/liketato.php', [
//            'form_params' => [
//                'liked_tato_id' => 157,
//                'liker_id' => 9,
//            ]
//        ]);
//
//        // compare response using regex
//        $this->assertRegexp('/^<img .*>\d+$/', $response->getBody());
//    }
//
//    public function testInvalidLikeRequest() {
//        $response = $this->client->request('POST', '/LouisBenjamin/UC3-Team-Project/includes/liketato.php', [
//            'form_params' => [
//                ''
//            ]
//        ]);
//
//        // compare response using regex
//        $this->assertRegexp('/^(?!<img .*>\d+)/', $response->getBody());
//    }
//}