<?php
include("Conectare.php");
$error = '';

if (isset($_POST['submit'])) {
    // Ia datele din formular
    $event_id = htmlentities($_POST['event_id'], ENT_QUOTES);
    $pret = htmlentities($_POST['pret'], ENT_QUOTES);
    $tip = htmlentities($_POST['tip'], ENT_QUOTES);

    // Verifică dacă sunt completate toate câmpurile
    if ($event_id == '' || $pret == '' || $tip == '') {
        $error = 'ERROR: Campuri goale!';
    } else {
        // Verifică existența evenimentului
        $check_event_query = "SELECT id FROM eveniment WHERE id = ?";
        if ($stmt_check_event = $conn->prepare($check_event_query)) {
            $stmt_check_event->bind_param("i", $event_id);
            $stmt_check_event->execute();
            $stmt_check_event->store_result();

            if ($stmt_check_event->num_rows == 0) {
                $error = 'ERROR: Evenimentul cu ID-ul specificat nu există.';
            } else {
                // Efectuează inserarea
                if ($stmt = $conn->prepare("INSERT INTO bilet (event_id, pret, tip) VALUES (?, ?, ?)")) {
                    $stmt->bind_param("ids", $event_id, $pret, $tip);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "ERROR: Nu se poate executa insert.";
                }
            }
            $stmt_check_event->close();
        } else {
            echo "ERROR: Nu se poate executa interogarea pentru verificarea evenimentului.";
        }
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Inserare Bilet</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1>Inserare Bilet</h1>
    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>
    <form action="" method="post">
        <div>
            <strong>ID Eveniment: </strong> <input type="text" name="event_id" value="" /><br />
            <strong>Pret: </strong> <input type="text" name="pret" value="" /><br />
            <strong>Tip: </strong> <input type="text" name="tip" value="" /><br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="VizualizareBilet.php">Vizualizeaza toate biletele</a>
        </div>
    </form>
</body>

</html>
