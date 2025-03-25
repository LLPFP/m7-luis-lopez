<?php
$servername = "mysql-luislpfp.alwaysdata.net";
$username = "luislpfp";
$password = "ThElement09";
$dbname = "luislpfp_hotelivac";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
