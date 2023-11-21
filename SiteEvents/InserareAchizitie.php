<?php
include("Conectare.php");
$error = '';
if (isset($_POST['submit'])) {
    //se iau datele din formular
    $bilet_id = htmlentities($_POST['bilet_id'], ENT_QUOTES);
    $cantitate = htmlentities($_POST['cantitate'], ENT_QUOTES);
    
    //se verifica daca sunt completate
    if ($bilet_id == '' || $cantitate == '') {
        $error = 'ERROR: Campuri goale!';
    } else {
        //acum se face insertul
        if (
            $stmt = $conn->prepare("INSERT INTO achizitie (bilet_id, cantitate) VALUES (?, ?)")
        ) {
            $stmt->bind_param("ii", $bilet_id, $cantitate);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "ERROR: Nu se poate executa insert.";
        }
    }
}
$conn->close();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>
        <?php echo "Inserare inregistrare Achizitie"; ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1>
        <?php echo "Inserare inregistrare Achizitie"; ?>
    </h1>
    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>
    <form action="" method="post">
        <div>
            <strong>Bilet ID: </strong> <input type="text" name="bilet_id" value="" /><br />
            <strong>Cantitate: </strong> <input type="text" name="cantitate" value="" /><br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="VizualizareAchizitie.php">Vizualizeaza toate achizitiile</a>
        </div>
    </form>
</body>

</html>
