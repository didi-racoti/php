<?php
// Conectare la baza de date
include("Conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $email = htmlentities($_POST['titlu'], ENT_QUOTES);
            $parola = htmlentities($_POST['descriere'], ENT_QUOTES);
            $locatie = htmlentities($_POST['locatie'], ENT_QUOTES);
            $data = htmlentities($_POST['data'], ENT_QUOTES);
            $contact = htmlentities($_POST['contact'], ENT_QUOTES);

            if ($email == '' || $contact == '' || $locatie == '' || $data == '' || $parola == '') {
                echo "<div> ERROR: Completați toate câmpurile obligatorii!</div>";
            } else {
                if ($stmt = $conn->prepare("UPDATE eveniment SET titlu=?, descriere=?, locatie=?, data=?, contact=? WHERE id=?")) {
                    $stmt->bind_param("sssssi", $email, $parola, $locatie, $data, $contact, $id);
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

                if ($result = $conn->query("SELECT * FROM eveniment where id='$id'")) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_object();
                        ?>
                        <strong>Titlu: </strong> <input type="text" name="titlu" value="<?php echo $row->titlu; ?>" /><br />
                        <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo $row->descriere; ?>" /><br />
                        <strong>Locatie: </strong> <input type="text" name="locatie" value="<?php echo $row->locatie; ?>" /><br />
                        <strong>Data: </strong> <input type="text" name="data" value="<?php echo $row->data; ?>" /><br />
                        <strong>Contact: </strong> <input type="text" name="contact" value="<?php echo $row->contact; ?>" /><br />
            <?php
                    }
                }
            }
            ?>
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="VizualizareEvent.php">Index</a>
        </div>
    </form>
</body>

</html>
