<?php
$hostname = 'localhost';
$username = 'root';
$parola = '';
$db = 'dbevents';
$conn = new mysqli($hostname, $username, $parola, $db);
if (!mysqli_connect_errno()) {
    echo 'Conectat la baza de date:' . $db;
}else{
    echo 'Nu se poate conecta';
    exit();
}
?>