<?php
class Dbh
{
    /** @var PDO  */
  public $dbh; // handle of the db connexion
  private static $instance;

  private function __construct() {
//    $dsn   = 'mysql:dbname=tato;unix_socket=/cloudsql/tato-231220:northamerica-northeast1:bestteam2019';
    $dsn  = "mysql:host=35.203.99.197;dbname=tato";
    $user =	"test";
    $password =	"tatouc3";
    try{
      $this->dbh = new PDO($dsn, $user, $password);
      //echo "Connected successfully";
    }catch(PDOException $e){
      echo 'Connection error!' .$e-> getMessage();
    }
  }

  public static function getInstance() {
    if (!isset(self::$instance)) {
      $object = __CLASS__;
      self::$instance = new $object;
    }
    return self::$instance;
  }

}


