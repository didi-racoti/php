<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Vizualizare Sponsor</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1>Inregistrarile din tabela Sponsor</h1>
    <p><b>Toate inregistrarile din Sponsor</b></p>
    <?php
    include("Conectare.php");
    if ($result = $conn->query("SELECT * FROM sponsor ORDER BY id ")) {
        if ($result->num_rows > 0) {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>ID</th><th>Nume</th><th>Descriere</th><th></th><th></th></tr>";
            while ($row = $result->fetch_object()) {
                echo "<tr>";
                echo "<td>" . $row->id . "</td>";
                echo "<td>" . $row->nume . "</td>";
                echo "<td>" . $row->descriere . "</td>";
                echo "<td><a href='ModificareSponsor.php?id=" . $row->id . "'>Modificare</a></td>";
                echo "<td><a href='StergereSponsor.php?id=" . $row->id . "'>Stergere</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nu sunt inregistrari in tabela!";
        }
        $result->close(); // Close the result set.
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close(); // Close the database connection.
    ?>
    <a href="InserareSponsor.php">Adaugarea unei noi inregistrari</a>
</body>

</html>
