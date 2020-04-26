<?php
include 'connection.php';

$act = $_POST['activity'];
$title =$_POST['title'];
$date = $_POST['date'];
    $sql ="INSERT INTO activities (account_id,activities,date,title,datesubmited,submitedby) 
            VALUES(1,'$act','$date','$title',CURDATE(),'lezter')";
            
    if ($conn->query($sql) === TRUE) {
        echo true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
     $conn->close();
?>