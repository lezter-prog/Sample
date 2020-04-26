<?php
include 'connection.php';

    $sql ="Select * from activities";
    $result = $conn->query($sql);
    $data = new \stdClass();
    $columns = new \stdClass();
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data->title = $row['title'];   
            $data->date = $row['date'];
            $array = array($data);
            
            $columns->data =$array;
            //$columns->data->date =$row['date'];
        }
    }
$myJSON =json_encode($columns);
echo $myJSON;    
?>