<?php
// conectare la baza de date database
include("Conectare.php");
// se verifica daca id a fost primit
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // preluam variabila 'id' din URL
    $id = $_GET['id'];
    // stergem inregistrarea cu ib=$id
    if ($stmt = $conn->prepare("DELETE FROM eveniment WHERE id = ? LIMIT 1")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "ERROR: Nu se poate executa delete.";
    }
    $conn->close();
    echo "<div>Inregistrarea a fost stearsa!!!!</div>";
}
echo "<p><a href=\"VizualizareEvent.php\">Inaoi spre vizualizarea evenimentelor</a></p>";