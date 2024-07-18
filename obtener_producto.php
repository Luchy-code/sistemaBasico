<?php
// obtener_producto.php

// Establecer conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";
$conex = mysqli_connect($server, $user, $pass, $bd);

// Verificar conexión
if (!$conex) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']));
}

// Recibir id del producto a editar
$id = $_POST['id'];

// Consulta para obtener los datos del producto
$consulta = "SELECT * FROM articulos WHERE id = ?";
$stmt = $conex->prepare($consulta);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $producto = $resultado->fetch_assoc();
    echo json_encode(['success' => true, 'data' => $producto]);
} else {
    echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
}

$stmt->close();
$conex->close();
?>
