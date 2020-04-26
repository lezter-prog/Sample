<?php
include $_SERVER['DOCUMENT_ROOT'].'/Sample/function/activitydatafunction.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/Sample/function/connection.php');

    $action =  $_POST['action'];
    $status = new \stdClass();
    switch ($action) {
        case "getdata":
            $activityClass = new ActivityClass();
            $status->data =$activityClass->getdata();
            break;
        case "test":
            $DBconnections = new DB_Connections();
            $conn = $DBconnections->mysqlConnection();
            $status->data =$conn;
            break;
        case "insertdata":
            $data = new \stdClass();
            $data->title = $_POST['title'];
            $data->act = $_POST['activity'];
            $data->date = $_POST['date'];
            $activityClass = new ActivityClass();
            $status->status =$activityClass->insertdata($data);
            break;

    }
    echo json_encode($status);
?>