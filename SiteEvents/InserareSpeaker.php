<?php
include("Conectare.php");
$error = '';

if (isset($_POST['submit'])) {
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);

    if (empty($nume) || empty($descriere)) {
        $error = 'ERROR: Campuri goale!';
    } else {
        if ($stmt = $conn->prepare("INSERT INTO Speaker (nume, descriere) VALUES (?, ?)")) {
            $stmt->bind_param("ss", $nume, $descriere);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "ERROR: Nu se poate executa insert.";
        }
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Inserare Speaker</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1>Inserare Speaker</h1>
    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>
    <form action="" method="post">
        <div>
            <strong>Nume: </strong> <input type="text" name="nume" value="" /><br />
            <strong>Descriere : </strong> <input type="text" name="descriere" value="" /><br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="VizualizareSpeaker.php">Vizualizeaza toți speakerii</a>
        </div>
    </form>
</body>

</html>
