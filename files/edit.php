<?php
require_once '../actions/connection.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM appointments WHERE id = {$id}";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $appointment = $result->fetch_assoc();
        $description = $appointment['description'];
        $day = $appointment['day'];
        $month = $appointment['month'];
        $remindingTime = $appointment['remindingTime'];
    } else {
        header("location: error.php");
    }
    $conn->close();
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style type="text/css">
    fieldset {
        margin: auto;
        margin-top: 100px;
        width: 60%;
    }
    </style>


</head>

<body>
    <fieldset>
        <legend class='h2'>Bearbeitungsanfrage</legend>
        <table class="table">
            <tr>
                <th>Bezeichnung</th>
                <td><input id="description" class="form-control" type="text" name="description"
                        value="<?php echo $description ?>" />
                </td>
            </tr>
            <tr>
                <th>Erinnerung</th>
                <td><input id="remindingTime" class="form-control" type="text" name="remindingTime" step="any"
                        value="<?php echo $remindingTime ?>" /></td>
            </tr>
            <tr>
                <th>Datum</th>
                <td class="d-flex">
                    <div>
                        <label for="day">Tag</label>
                        <input id="day" class="form-control" type="text" name="day" step="any"
                            value="<?php echo $day ?>" />
                    </div>
                    <div>
                        <label for="month">Monat</label>
                        <input id="month" class="form-control" type="text" name="month" step="any"
                            value="<?php echo $month ?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <button onclick="editAppointment(<?= $id ?>)" class="btn btn-success">Änderungen
                        speichern</button>
                </td>
                <td>
                    <a href="calender.php"><button class="btn btn-warning" type="button">Zurück</button></a>
                </td>
            </tr>
        </table>
    </fieldset>

    <script>
    function editAppointment(id) {
        console.log("here")
        $(document).ready(function() {
            $.ajax({
                url: 'aEdit.php',
                type: 'POST',
                data: {
                    id: id,
                    description: $('#description').val(),
                    day: $('#day').val(),
                    month: $('#month').val(),
                    remindingTime: $('#remindingTime').val(),
                    action: "edit"
                },
                success: function(response) {
                    if (response == 1) {
                        alert("Der Termin wurde erfolgreich bearbeitet!");
                    } else if (response == 0) {
                        alert("Der Termin kann nicht bearbeitet werden!")
                    }
                }
            });
        });
    }
    </script>

</body>

</html>