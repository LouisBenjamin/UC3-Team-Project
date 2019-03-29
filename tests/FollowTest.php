<?php
//require __DIR__ . '/../includes/follow.php';
////require('vendor/autoload.php');
//
//use PHPUnit\Framework\TestCase;
//
//class FollowTest extends TestCase
//{
//    protected $client;
//
//    protected function setUp() {
//        $this->client = new GuzzleHttp\Client([
//            'base_uri' =>"http://localhost/" // /LouisBenjamin/UC3-Team-Project
//        ]);
//    }
//
//    public function testValidFollowRequest() {
//        $response = $this->client->request('POST', '/LouisBenjamin/UC3-Team-Project/includes/follow.php', [
//            'form_params' => [
//                'idol_id' => 9,
//                'fan_id' => 2,
//            ]
//        ]);
//
//        // compare response using regex
//        $this->assertRegexp('/^Follow(ed)?$/', $response->getBody());
//    }
//
//    public function testInvalidFollowRequest() {
//        $response = $this->client->request('POST', '/LouisBenjamin/UC3-Team-Project/includes/follow.php', [
//            'form_params' => [
//                ''
//            ]
//        ]);
//
//        // compare response using regex
//        $this->assertRegexp('/^Follow$/', $response->getBody());
//    }
//}