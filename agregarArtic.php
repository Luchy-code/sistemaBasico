<?php
session_start();
$server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";

// Conexión a la base de datos
$conex = mysqli_connect($server, $user, $pass, $bd);

// Verificar conexión
if (!$conex) {
    die(json_encode(['success' => false, 'message' => 'Error en la conexión a la base de datos: ' . mysqli_connect_error()]));
}

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$marca = $_POST['marca'];
$precio = $_POST['precio'];
$cant = $_POST['cant'];

if (!empty($id) && !empty($nombre) && !empty($marca) && !empty($precio) && !empty($cant)) {
    // Verificar si el ID ya existe
    $consultaUsuario = "SELECT * FROM `articulos` WHERE id=?";
    $stmt = $conex->prepare($consultaUsuario);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultadoUsuario = $stmt->get_result();

    if ($resultadoUsuario->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'ID ya existe']);
        $stmt->close();
        $conex->close();
        exit();
    }
    $stmt->close();

    // Verificar si el artículo ya existe
    $consultaArticulo = "SELECT * FROM `articulos` WHERE nombre=? AND marca=?";
    $stmt = $conex->prepare($consultaArticulo);
    $stmt->bind_param("ss", $nombre, $marca);
    $stmt->execute();
    $resultadoArticulo = $stmt->get_result();

    if ($resultadoArticulo->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Artículo ya existe']);
        $stmt->close();
        $conex->close();
        exit();
    }
    $stmt->close();

    // Insertar el artículo
    $consulta = "INSERT INTO `articulos`(`id`, `nombre`, `tipo`,`marca`, `precio`, `cant`) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conex->prepare($consulta);
    $stmt->bind_param("issdi", $id, $nombre, $marca, $precio, $cant);
    $resultado = $stmt->execute();

    if ($resultado) {
        echo json_encode(['success' => true, 'message' => 'Artículo registrado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar el artículo: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Algún campo está vacío']);
}

$conex->close();
?>
