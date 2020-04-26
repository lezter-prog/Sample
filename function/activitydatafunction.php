<?php
include 'connection.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/Sample/function/connection.php');
class ActivityClass {
    public static function getdata() {
      $DBconnection = new DB_Connections();
      $conn = $DBconnection->mysqlConnection();
      $sql ="Select * from activities";
      $result = $conn->query($sql);
      
      //$columns = new \stdClass();
      $array = array();   
      if ($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
              $data = new \stdClass();
              $data->title = $row['title'];   
              $data->date = $row['date'];
              array_push($array,$data);  
          }
          //$columns->data =$array;
      }
      return $array;
    }
    public static function insertdata($data){
      $DBconnection = new DB_Connections();
      $conn = $DBconnection->mysqlConnection();
      $sql ="INSERT INTO activities (account_id,activities,date,title,datesubmited,submitedby) 
            VALUES(1,'$data->act','$data->date','$data->title',CURDATE(),'lezter')";
      try{
        if ($conn->query($sql) === TRUE) {
          return TRUE;
      } else {
          return "Error: " . $sql . "<br>" . $conn->error;
      }
      }catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
      }
      $conn->close();
    }
  }       
?>