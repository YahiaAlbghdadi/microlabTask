<?php

require_once "../actions/connection.php";

$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);
$appointments = $result->fetch_all(MYSQLI_ASSOC);
foreach ($appointments as $appointment) {
    if ($appointment['remindingTime'] == 7) {
        $appointment['remindingTime'] = "1 Woche";
    } elseif ($appointment['remindingTime'] == 14) {
        $appointment['remindingTime'] = "2 Wochen";
    } elseif ($appointment['remindingTime'] == 1) {
        $appointment['remindingTime'] = "1 Tag";
    } else {
        $appointment['remindingTime'] = $appointment['remindingTime'] . " Tage";
    };
    echo "
        <tr id='{$appointment['id']}'>
            <td>{$appointment['day']}.{$appointment['month']}.</td>
            <td>{$appointment['description']}</td>
            <td>{$appointment['remindingTime']}</td>
            <td><a class='appointmentActions' href='edit.php?id={$appointment['id']}'>bearbeiten</a> | <button class='deleteButton' onclick='deleteAppointment({$appointment['id']})' >löschen</button></td>
        </tr>
    ";
}