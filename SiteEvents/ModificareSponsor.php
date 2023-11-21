<?php
include("Conectare.php");
$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $nume = htmlentities($_POST['nume'], ENT_QUOTES);
            $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);

            if ($nume == '' || $descriere == '') {
                echo "<div> ERROR: Completați toate câmpurile obligatorii!</div>";
            } else {
                if ($stmt = $conn->prepare("UPDATE sponsor SET nume=?, descriere=? WHERE id=?")) {
                    $stmt->bind_param("ssi", $nume, $descriere, $id);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "ERROR: Nu se poate executa update.";
                }
            }
        } else {
            echo "ID incorect!";
        }
    }
}
?>

<html>

<head>
    <title>
        <?php echo isset($_GET['id']) ? "Modificare inregistrare" : ""; ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>

<body>
    <h1>
        <?php echo isset($_GET['id']) ? "Modificare Inregistrare" : ""; ?>
    </h1>
    <?php
    if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    }
    ?>
    <form action="" method="post">
        <div>
            <?php if (isset($_GET['id'])) {
                $id = $_GET['id'];
                echo "<input type='hidden' name='id' value='$id' />";
                echo "<p>ID: $id</p>";

                if ($result = $conn->query("SELECT * FROM sponsor where id='$id'")) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_object();
                        ?>
                        <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo $row->nume; ?>" /><br />
                        <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo $row->descriere; ?>" /><br />
            <?php
                    }
                }
            }
            ?>
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="VizualizareSponsor.php">Index</a>
        </div>
    </form>
</body>

</html>
