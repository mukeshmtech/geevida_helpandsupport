<?php
class DBController {

  private $host;
  private $user;
  private $pass;
  private $db;
  public $mysqli;

  public function __construct() {
    $this->db_connect();
  }

  private function db_connect(){
    $this->host = 'localhost';
    $this->user = 'root';
    $this->pass = '';
    $this->db = 'geevida_helpandsupport';

    $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);

    return $this->mysqli;
  }

  public function db_num($sql){
        $result = $this->mysqli->query($sql);
        return $result->num_rows;
  }

  public function runQuery($sql){
    $data = $this->mysqli->query($sql);
    if (!$data) {
        throw new Exception("Database Error [{$this->mysqli->errno}] {$this->mysqli->error}");
    }
    return $data;
  }

  public function getRow($sql){

    $data = $this->runQuery($sql); 
    $result = $data->fetch_assoc();
    $data = json_encode($result);
    return $data;
  }

  public function getArray($sql){
    $data = $this->runQuery($sql); $result = array();
    while($arr = $data->fetch_assoc()){
      $result[]= $arr; 
    }
    $data = json_encode($result);
    return $data;
  }

  public function stringEscape($str){
    $data = $this->mysqli->real_escape_string($str);
    return $data;
  }

  public function filter($str) {  
    $str = trim(htmlentities(strip_tags($str)));
    $str = stripslashes($str);
    $str = $this->mysqli->real_escape_string($str);
    return $str;
  }

  public function filterPost($input) {  
  
    foreach ($input as $key => $value) {
      $data[$key] = $this->filter($value);
    }
    return $data;
  }

}
?>