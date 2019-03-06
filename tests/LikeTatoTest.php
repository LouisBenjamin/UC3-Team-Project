<?php
include_once __DIR__ . '/../includes/liketato.php';
require('vendor/autoload.php');

use PHPUnit\Framework\TestCase;

class LikeTatoTest extends TestCase
{
    protected $client;

    protected function setUp() {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => "http://127.0.0.1:8080"
        ]);
    }

    public function testValidLikeRequest() {
        $response = $this->client->request('POST', '/uc3/includes/liketato.php', [
            'form_params' => [
                'liked_tato_id' => 115,
                'liker_id' => 9,
            ]
        ]);

        // compare response using regex
        $this->assertRegexp('/^Liked? \d+$/', $response->getBody());
    }

    public function testInvalidLikeRequest() {
        $response = $this->client->request('POST', '/uc3/includes/liketato.php', [
            'form_params' => [
                ''
            ]
        ]);

        // compare response using regex
        $this->assertRegexp('/^(?!Liked? \d+)/', $response->getBody());
    }
}
//
//class LikeTatoTest extends WP_UnitTestCase
//{
//
//    public function testRequest() {
//
//
//        $client = static::createClient();
//        $client->request('POST', '/../includes/liketato.php', array(),
//            array(),
//            array('CONTENT_TYPE' => 'application/json'),
//            '[{liked_tato_id:115,liker_id:9}]'
//        );
//        $this->assertEquals(
//            200,
//            $client->getResponse()
//                ->getStatusCode()
//        );
//    }
//}