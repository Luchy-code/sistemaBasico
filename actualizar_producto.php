<?php
// actualizar_producto.php

// Establecer conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";
$conex = mysqli_connect($server, $user, $pass, $bd);

// Verificar conexión
if (!$conex) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos: ' . mysqli_connect_error()]));
}

// Recibir datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$tipo = $_POST['tipo'];
$precio = $_POST['precio'];
$cant = $_POST['cant'];
$lote = $_POST['lote'];

$cantidad_nueva = $lote + $cant;

// Actualizar el producto en la base de datos
$actualizar = "UPDATE articulos SET nombre=?, marca=?, tipo=?, precio=?, cant=? WHERE id=?";
$stmt = $conex->prepare($actualizar);

if ($stmt) {
    $stmt->bind_param("sssiii", $nombre, $marca, $tipo, $precio, $cantidad_nueva, $id);
    $resultado = $stmt->execute();

    if ($resultado) {
        echo json_encode(['success' => true, 'message' => 'Producto actualizado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el producto: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . $conex->error]);
}

$conex->close();
?>
