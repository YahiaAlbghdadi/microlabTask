<?php
require_once "../actions/connection.php";

if (isset($_POST['action'])) {
    if ($_POST['action'] == "edit") {
        edit();
    }
}

function edit()
{

    global $conn;
    $id = $_POST['id'];
    $description = $_POST['description'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $remindingTime = $_POST['remindingTime'];

    mysqli_query($conn, "UPDATE appointments SET day=$day,month=$month,description='$description',remindingTime=$remindingTime WHERE id = $id");
    echo 1;
}