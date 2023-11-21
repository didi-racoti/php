<?php
include("Conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $email = htmlentities($_POST['email'], ENT_QUOTES);
            $parola = htmlentities($_POST['parola'], ENT_QUOTES);
            $nume = htmlentities($_POST['nume'], ENT_QUOTES); // Adăugat nume în procesul de modificare
            $tip = htmlentities($_POST['tip'], ENT_QUOTES);

            if ($email == '' || $parola == '' || $nume == '' || $tip == '') {
                $error = "ERROR: Completati campurile obligatorii!";
            } else {
                if ($stmt = $conn->prepare("UPDATE user SET email=?, parola=?, nume=?, tip=? WHERE id=?")) {
                    $stmt->bind_param("ssssi", $email, $parola, $nume, $tip, $id);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    $error = "ERROR: Nu se poate executa update." . $conn->error;
                }
            }
        } else {
            $error = "ID incorect!";
        }
    }
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    if ($stmt = $conn->prepare("SELECT * FROM user WHERE id=?")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_object();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Modificare Inregistrare</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1>Modificare Inregistrare</h1>
    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>
    <form action="ModificareUser.php" method="post">
        <div>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <p>ID: <?php echo $id; ?></p>
            <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo $row->nume; ?>" /><br /> <!-- Adăugat câmpul pentru nume -->
            <strong>Email: </strong> <input type="text" name="email" value="<?php echo $row->email; ?>" /><br />
            <strong>Parola: </strong> <input type="text" name="parola" value="<?php echo $row->parola; ?>" /><br />
            <strong>Tip: </strong> <input type="text" name="tip" value="<?php echo $row->tip; ?>" /><br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="VizualizareUser.php">Index</a>
        </div>
    </form>
</body>

</html>

<?php
        }
        $stmt->close();
    }
}

$conn->close();
?>
