<?php
include 'connection.php';

$act = $_POST['activity'];
$title =$_POST['title'];
$date = $_POST['date'];
    $sql ="INSERT INTO activities (activity_id,account_id,activities,date,title,datesubmited,submitedby) 
            VALUES(2,1,'$act',$date,'$title',$date,'lezter')";
            
    if ($conn->query($sql) === TRUE) {
        echo true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
     $conn->close();
?>