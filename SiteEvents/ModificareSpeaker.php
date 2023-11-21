<?php
include("Conectare.php");

$error = '';

if (isset($_POST['submit'])) {
    if (!empty($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];
        $nume = htmlentities($_POST['nume'], ENT_QUOTES);
        $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);

        if (empty($nume) || empty($descriere)) {
            $error = "ERROR: Completați toate câmpurile obligatorii!";
        } else {
            if ($stmt = $conn->prepare("UPDATE Speaker SET nume=?, descriere=? WHERE id=?")) {
                $stmt->bind_param("ssi", $nume, $descriere, $id);
                $stmt->execute();
                $stmt->close();
            } else {
                $error = "ERROR: Nu se poate executa update.";
            }
        }
    } else {
        $error = "ID incorect!";
    }
}
?>

<html>

<head>
    <title>
        <?php echo isset($_GET['id']) ? "Modificare speaker" : ""; ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>

<body>
    <h1>
        <?php echo isset($_GET['id']) ? "Modificare Speaker" : ""; ?>
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

                if ($result = $conn->query("SELECT * FROM Speaker WHERE id='$id'")) {
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
            <a href="VizualizareSpeaker.php">Index</a>
        </div>
    </form>
</body>

</html>
