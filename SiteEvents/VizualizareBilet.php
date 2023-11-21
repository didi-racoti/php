<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Vizualizare Bilete</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1>Biletele din tabela bilete</h1>
    <p><b>Toate biletele</b></p>
    <?php
    include("Conectare.php");
    if ($result = $conn->query("SELECT * FROM bilet ORDER BY id ")) {
        // echo $result;
        if ($result->num_rows > 0) {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>ID</th><th>ID Eveniment</th><th>Pret</th><th>Tip</th><th></th><th></th></tr>";
            while ($row = $result->fetch_object()) {
                echo "<tr>";
                echo "<td>" . $row->id . "</td>";
                echo "<td>" . $row->event_id . "</td>";
                echo "<td>" . $row->pret . "</td>";
                echo "<td>" . $row->tip . "</td>";
                echo "<td><a href='ModificareBilet.php?id=" . $row->id . "'>Modificare</a></td>";
                echo "<td><a href='StergereBilet.php?id=" . $row->id . "'>Stergere</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nu sunt inregistrari in tabela!";
        }
        $result->close(); // Închide setul de rezultate.
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close(); 
    ?>
    <a href="InserareBilet.php">Adaugarea unui nou bilet</a>
</body>

</html>
