<?php

require_once "../actions/connection.php";



if (isset($_POST["action"]) && $_POST["action"] == "insert") {
    $day = $_POST['day'];
    $month = $_POST['month'];
    $description = $_POST['description'];
    $remindingTime = $_POST['remindingTime'];

    $sql = "INSERT INTO appointments( day, month, description, remindingTime) VALUES ($day,$month,'$description',$remindingTime)";

    mysqli_query($conn, $sql);
}