<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basededatosprueba";
$conn = new mysqli($servername, $username, $password, $dbname);
// Verificador de errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} else {
    echo "Conexión exitosa";
    echo PHP_VERSION;
}
?>

