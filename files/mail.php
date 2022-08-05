<?php


require_once "../actions/connection.php";
$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);
while ($appointments = $result->fetch_assoc()) {
    if ($appointments['remindingTime'] > $appointments['day']) {
        $appointments['month'] -= 1;
        $appointments['day'] += 30;
    }
    $today = date("m-d");
    $sendTime = $appointments['month'] . "-" . ($appointments['day'] - $appointments['remindingTime']);
    if ($today == $sendTime) {
        mail("albghdadiyahia5@gmail.com", "Termin Erinnerung", "Bezeichnung: {$appointments['description']}. Am: {$appointments['month']}-{$appointments['day']}.", "From: Yahia Albghdadi");
        exit;
    }
    mail("albghdadiyahia5@gmail.com", "Termin Erinnerung", "Bezeichnung:", "From: Yahia Albghdadi");
    exit;
}