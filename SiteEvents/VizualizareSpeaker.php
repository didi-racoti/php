<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Vizualizare Speakeri</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1>Vizualizare Speakeri</h1>
    <p><b>Toți speakerii</b></p>
    <?php
    include("Conectare.php");
    if ($result = $conn->query("SELECT * FROM Speaker ORDER BY id")) {
        if ($result->num_rows > 0) {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>ID</th><th>Nume</th><th>Descriere</th><th></th><th></th></tr>";
            while ($row = $result->fetch_object()) {
                echo "<tr>";
                echo "<td>" . $row->id . "</td>";
                echo "<td>" . $row->nume . "</td>";
                echo "<td>" . $row->descriere . "</td>";
                echo "<td><a href='ModificareSpeaker.php?id=" . $row->id . "'>Modificare</a></td>";
                echo "<td><a href='StergereSpeaker.php?id=" . $row->id . "'>Stergere</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nu sunt înregistrări în tabela!";
        }
        $result->close(); // Close the result set.
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close(); // Close the database connection.
    ?>
    <a href="InserareSpeaker.php">Adăugare un nou speaker</a>
</body>

</html>
