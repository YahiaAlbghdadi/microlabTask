<?php
require_once "../actions/connection.php";

if (isset($_POST['action'])) {
    if ($_POST['action'] == "delete") {
        delete();
    }
}

function delete()
{

    global $conn;
    $id = $_POST['id'];

    mysqli_query($conn, "DELETE FROM appointments WHERE id = $id");
    echo 1;
}