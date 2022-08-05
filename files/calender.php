<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../styles/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <div class="header">
        <hr class="logoHr" />
        <h1 class="logo">logo</h1>
    </div>
    <div class="parent">
        <div class="squareOne">
            <ul class="navbar">
                <li class="navbarItems home">Home</li>
                <li class="navbarItems">
                    <a class="link" href="index.php">Menüpunkt 1</a>
                </li>
                <li class="navbarItems">
                    <a class="link" href="calender.php">Menüpunkt 2</a>
                </li>
            </ul>
        </div>
        <div class="formParent">
            <div class="formbox ">
                <div class="formHolder">
                    <div class="components justify-content-start">
                        <label for="month">Datum(TT/MM)</label>
                        <div class="dateInputs row">
                            <input placeholder="Tag" name="day" id="day" type="number" class="dateInput col">
                            <input placeholder="Monat" name="month" id="month" type="number" class="dateInput col">
                        </div>
                    </div>
                    <div class="components">
                        <label for="description">
                            Bezeichnung
                        </label>
                        <input placeholder="Bezeichnung eintragen" type="text" name="description" id="description"
                            class="row">
                    </div>
                    <div class="components">
                        <label for="remindingTime">Erinnerung</label>
                        <select class="row" name="remindingTime" id="remindingTime">
                            <option value="" selected disabled hidden>--bitte auswählen--</option>
                            <option value="1">1 Tag</option>
                            <option value="2">2 Tage</option>
                            <option value="4">4 Tage</option>
                            <option value="7">1 Woche</option>
                            <option value="14">2 Wochen</option>
                        </select>
                    </div>
                </div>

                <button onclick="insertRecord()" class="submitButton">SPEICHERN</button>
            </div>
            <table id="appointments" class="tester">
                <tr>
                    <th>Datum</th>
                    <th>Bezeichnung</th>
                    <th>Erinnerung</th>
                    <th>Aktion</th>
                </tr>
            </table>
        </div>

        <div class="squareTwo"></div>
    </div>
    <script>
    //Delete Function
    function deleteAppointment(id) {
        $(document).ready(function() {
            $.ajax({
                // Action
                url: 'delete.php',
                //Method
                type: 'POST',
                data: {
                    // Get value
                    id: id,
                    action: "delete"
                },
                success: function(response) {
                    if (response == 1) {
                        alert("Der Termin wurde erfolgreich gelöscht!");
                        document.getElementById(id).style.display = "none";
                    } else if (response == 0) {
                        alert("Der Termin kann nicht gelöscht werden!")
                    }
                }
            });
        });
    }

    function insertRecord() {
        $(document).ready(function() {
            $.ajax({
                type: 'POST',
                url: 'insert.php',
                data: {
                    day: $('#day').val(),
                    month: $('#month').val(),
                    description: $('#description').val(),
                    remindingTime: $('#remindingTime').val(),
                    action: "insert"
                },
                success: function(response) {
                    $('#day').val("");
                    $('#month').val("");
                    $('#description').val("");
                    $('#remindingTime').val("");
                    updateLayout();

                }
            });
        });

    }

    function updateLayout() {
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "layout.php",
                dataType: "html",
                success: function(data) {
                    $('#appointments').html(`<tr>
                    <th>Datum</th>
                    <th>Bezeichnung</th>
                    <th>Erinnerung</th>
                    <th>Aktion</th>
                </tr>`)
                    $('#appointments').append(data)
                }
            })
        });
    }

    function sendReminder() {
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "mail.php"
            })
        });
    }
    setInterval(function() {
        sendReminder();
    }, 3600000);
    $(document).ready(function() {
        updateLayout()
    })
    </script>
</body>

</html>