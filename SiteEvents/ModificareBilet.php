<?php // connectare bazadedate
include("Conectare.php");

$error = '';
if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $event_id = htmlentities($_POST['event_id'], ENT_QUOTES);
            $pret = htmlentities($_POST['pret'], ENT_QUOTES);
            $tip = htmlentities($_POST['tip'], ENT_QUOTES);

            if ($event_id == '' || $pret == '' || $tip == '') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if (
                    $stmt = $conn->prepare("UPDATE tbl_product SET
event_id=?,pret=?,tip=? WHERE id='" . $id . "'")
                ) {
                    $stmt->bind_param(
                        "ids",
                        $event_id,
                        $pret,
                        $tip
                    );
                    $stmt->execute();
                    $stmt->close();
                }
                else {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        }

        else {
            echo "id incorect!";
        }
    }
} ?>
<html>

<head>
    <title>
        <?php if ($_GET['id'] != '') {
            echo "Modificare inregistrare";
        } ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>

<body>
<h1>
    <?php if ($_GET['id'] != '') {
        echo "Modificare Inregistrare";
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
            if ($result = $conn->query("SELECT * FROM bilet where id='" . $_GET['id'] . "'")) {
            if ($result->num_rows > 0) {
            $row = $result->fetch_object(); ?>
        </p>
        <strong>Event_Id: </strong> <input type="text" name="event_id" value="<?php echo $row->event_id;
        ?>" /><br />
        <strong>Pret: </strong> <input type="text" name="pret" value="<?php echo $row->pret;
        ?>" /><br />
        <strong>Tip: </strong> <input type="text" name="tip" value="<?php echo $row->tip;
        }
        }
        } ?>" /><br />
        <br />
        <input type="submit" name="submit" value="Submit" />
        <a href="Vizualizare.php">Index</a>
    </div>
</form>
</body>

</html>
