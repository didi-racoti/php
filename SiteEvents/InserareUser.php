<?php
include("Conectare.php");
$error = '';

if (isset($_POST['submit'])) {
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $parola = htmlentities($_POST['parola'], ENT_QUOTES);
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $tip = htmlentities($_POST['tip'], ENT_QUOTES); // Adăugat tip în procesul de inserare

    if ($email == '' || $parola == '' || $nume == '' || $tip == '') {
        $error = 'ERROR: Campuri goale!';
    } else {
        if ($stmt = $conn->prepare("INSERT INTO user (email, parola, nume, tip) VALUES (?, ?, ?, ?)")) {
            $stmt->bind_param("ssss", $email, $parola, $nume, $tip);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "ERROR: Nu se poate executa insert." . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Inserare inregistrare</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1>Inserare inregistrare</h1>
    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>
    <form action="InserareUser.php" method="post">
        <div>
            <strong>Nume: </strong> <input type="text" name="nume" value="" /><br />
            <strong>Email: </strong> <input type="text" name="email" value="" /><br />
            <strong>Parola: </strong> <input type="text" name="parola" value="" /><br />
            <strong>Tip: </strong> <input type="text" name="tip" value="" /><br /> <!-- Adăugat câmpul pentru tip -->
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="VizualizareUser.php">Vizualizeaza toti userii</a>
            <a href="VizualizareAchizitie.php">Vizualizeaza toate achizitiile</a>
        </div>
    </form>
</body>

</html>
