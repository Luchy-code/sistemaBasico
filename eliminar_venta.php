<?php
session_start();
$server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";

$conex = mysqli_connect($server, $user, $pass, $bd);

if (!$conex) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM ventas WHERE id = $id";
    if (mysqli_query($conex, $sql)) {
        echo "correcto";
    } else {
        echo "error: " . mysqli_error($conex);
    }
}

mysqli_close($conex);
header("Location: registrarVenta.php");
exit();
?>
