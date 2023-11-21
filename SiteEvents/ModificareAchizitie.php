<?php
include("Conectare.php");

$error = '';
if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $bilet_id = htmlentities($_POST['bilet_id'], ENT_QUOTES);
            $cantitate = htmlentities($_POST['cantitate'], ENT_QUOTES);

            if ($bilet_id == '' || $cantitate == '') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if (
                    $stmt = $conn->prepare("UPDATE achizitie SET bilet_id=?, cantitate=? WHERE id='" . $id . "'")
                ) {
                    $stmt->bind_param(
                        "ii",
                        $bilet_id,
                        $cantitate
                    );
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "ERROR: Nu se poate executa update.";
                }
            }
        } else {
            echo "id incorect!";
        }
    }
}
?>

<html>

<head>
    <title>
        <?php if ($_GET['id'] != '') {
            echo "Modificare inregistrare Achizitie";
        } ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>

<body>
    <h1>
        <?php if ($_GET['id'] != '') {
            echo "Modificare Inregistrare Achizitie";
        } ?>
    </h1>
    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>
    <form action="" method="post">
        <div>
            <?php if ($_GET['id'] != '') { ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                <p>ID:
                    <?php echo $_GET['id'];
                    if ($result = $conn->query("SELECT * FROM achizitie WHERE id='" . $_GET['id'] . "'")) {
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_object(); ?>
                </p>
                <strong>Bilet ID: </strong> <input type="text" name="bilet_id" value="<?php echo $row->bilet_id; ?>" /><br />
                <strong>Cantitate: </strong> <input type="text" name="cantitate" value="<?php echo $row->cantitate; ?>" /><br />
                <br />
                <input type="submit" name="submit" value="Submit" />
                <a href="VizualizareAchizitie.php">Index</a>
            <?php
                        }
                    }
                } ?>
        </div>
    </form>
</body>

</html>
