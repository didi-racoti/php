<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1>Inregistrarile din tabela User</h1>
    <p><b>Toate inregistrarile din User</b></p>
    <?php
    include("Conectare.php");
    if ($stmt = $conn->prepare("SELECT * FROM user ORDER BY id ")) {
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>ID</th><th>Nume</th><th>Email</th><th>Parola</th><th>Tip</th><th></th><th></th></tr>";
            while ($row = $result->fetch_object()) {
                echo "<tr>";
                echo "<td>" . $row->id . "</td>";
                echo "<td>" . $row->nume . "</td>";
                echo "<td>" . $row->email . "</td>";
                echo "<td>" . $row->parola . "</td>";
                echo "<td>" . $row->tip . "</td>"; // Adăugat tip în afișare
                echo "<td><a href='ModificareUser.php?id=" . $row->id . "'>Modificare</a></td>";
                echo "<td><a href='StergereUser.php?id=" . $row->id . "'>Stergere</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nu sunt inregistrari in tabela!";
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
    ?>
    <a href="InserareUser.php">Adaugarea unei noi inregistrari</a>
</body>

</html>
