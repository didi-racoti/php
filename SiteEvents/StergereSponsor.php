<?php
include("Conectare.php");
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    if ($stmt = $conn->prepare("DELETE FROM sponsor WHERE id = ? LIMIT 1")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "ERROR: Nu se poate executa delete.";
    }
    $conn->close();
    echo "<div>Inregistrarea a fost stearsa!!!!</div>";
}
echo "<p><a href=\"VizualizareSponsor.php\">Inapoi spre vizualizarea sponsorilor</a></p>";
?>
