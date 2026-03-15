<?php
class database {
 private $conexion;
 private $resultc;
 private $sql;
 public static $queries;
 private static $_singleton;
 const HOST = "localhost";
 const USER = "root";
 const PASS = "";
 const DB = "peliculas";
 public static function getInstance(){
 if(is_null (self::$_singleton)) {
 self::$_singleton = new DataBase();
 }
 return self::$_singleton;
 }
 private function __construct(){
 $this->conexion = new mysqli(self::HOST, self::USER, self::PASS, self::DB);
 self::$queries = 0;
 }
 /*public function execute(){
 if(!($this->resource = mysql_query($this->sql, $this->conexion))){
 return null;
 }
 self::$queries++;
 return $this->resource;
 }*/
 public function alter(){
 if(!($this->resource = mysql_query($this->sql, $this->conexion))){
 return false;
 }
 return true;
 }
 public function loadObjectList(){ 
    //Ejecutando la consulta a través del objeto $db
 $this->resultc = $this->conexion->query($this->sql);
 //Obteniendo el número de registros devueltos
 $num_results = $this->resultc->num_rows;

 while($row = $this->resultc->fetch_assoc()){
 $array[] = $row;
 }
 return $array;
 }
 public function setQuery($sql){
 if(empty($sql)){
 return false;
 }
 $this->sql = $sql;
 return true;
 }

 public function getNumRows($sql){
 if($this->setQuery($sql)){
 //Ejecutando la consulta a través del objeto $db
 $this->resultc = $this->conexion->query($this->sql);
 //Obteniendo el número de registros devueltos

 while($row = $this->resultc->fetch_assoc()){
 $total = $row['total'];
 }
 return $total;
 }
 else{
 return false;
 }
 }
}
?>