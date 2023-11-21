<?php
include("Conectare.php");
$error = '';
if (isset($_POST['submit'])) {
    //se iau datele din formular
    $email = htmlentities($_POST['titlu'], ENT_QUOTES);
    $parola = htmlentities($_POST['descriere'], ENT_QUOTES);
    $data = htmlentities($_POST['data'], ENT_QUOTES);
    $locatie = htmlentities($_POST['locatie'], ENT_QUOTES);
    $contact = htmlentities($_POST['contact'], ENT_QUOTES);
    
    //se verifica daca sunt completate
    if ($email == '' || $parola == '' || $data == '' || $locatie == '' || $contact == '') {
        $error = 'ERROR: Campuri goale!';
    } else {
        //acum se face insertul
        if (
            $stmt = $conn->prepare("INSERT into eveniment (titlu, descriere, data, locatie, contact) VALUES (?, ?, ?, ?, ?)")
        ) {
            $stmt->bind_param("ssdss", $email, $parola, $data, $locatie, $contact);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "ERROR: Nu se poate executa insert.";
        }

    }
}
// $mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>
        <?php echo "Inserare inregistrare"; ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1>
        <?php echo "Inserare inregistrare"; ?>
    </h1>
    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>
    <form action="" method="post">
        <div>
            <strong>Titlu: </strong> <input type="text" name="titlu" value="" /><br />
            <strong>Descriere : </strong> <input type="text" name="descriere" value="" /><br />
            <strong>Data: </strong> <input type="text" name="data" value="" /><br />
            <strong>Locatie: </strong> <input type="text" name="locatie" value="" /><br />
            <strong>Contact: </strong> <input type="text" name="contact" value="" /><br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="VizualizareEvent.php">Vizualizeaza toate evenimentele</a>
        </div>
    </form>
</body>

</html>