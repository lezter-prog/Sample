<?php
Class DB_Connections{
    public static function mysqlConnection(){
      $host = 'localhost';
      $user = 'root';
      $pass = '';
      $db = 'test';
      try {
        $conn = new mysqli($host, $user, $pass, $db);
        if($conn->connect_error) 
          die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

      } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
      }

    return $conn;
    }
}
 
?>