<?php
include("Conectare.php");

// se verifica daca id a fost primit
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // preluam variabila 'id' din URL
    $id = $_GET['id'];

    // stergem inregistrarea cu id=$id
    if ($stmt = $conn->prepare("DELETE FROM Speaker WHERE id = ? LIMIT 1")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        echo "<div>Inregistrarea a fost stearsa!!!!</div>";
    } else {
        echo "ERROR: Nu se poate executa delete.";
    }

    $conn->close();
}

echo "<p><a href=\"VizualizareSpeaker.php\">Înapoi spre vizualizarea speakerilor</a></p>";
?>
