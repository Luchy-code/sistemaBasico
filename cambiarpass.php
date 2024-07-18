<?php
session_start();

// Variables de conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";

// Establecer conexión con la base de datos
$conex = mysqli_connect($server, $user, $pass, $bd);

// Verificar si la conexión fue exitosa
if (!$conex) {
    $_SESSION['error'] = "Problemas con la conexión a la base de datos";
    header("Location: error.php");
    exit();
}

// Recibir datos del formulario
$usuario = $_POST['dni'];
$nueva_clave = $_POST['password'];

// Validar que los campos no estén vacíos
if (empty($usuario) || empty($nueva_clave)) {
    $_SESSION['error'] = "Por favor complete todos los campos";
    header("Location: login.php");
    exit();
}

// Consultar si el usuario existe
$consultaUsuario = "SELECT * FROM `empleados` WHERE dni='$usuario'";
$resultadoUsuario = mysqli_query($conex, $consultaUsuario);

if (!$resultadoUsuario || mysqli_num_rows($resultadoUsuario) == 0) {
    $_SESSION['error'] = "Usuario no encontrado";
    header("Location: login.php");
    exit();
}

// Actualizar la contraseña del usuario
$cambiarClave = "UPDATE `empleados` SET `pass` = '$nueva_clave' WHERE `dni` = '$usuario'";
$resultado = mysqli_query($conex, $cambiarClave);

if ($resultado) {
    $_SESSION['success'] = "Contraseña cambiada exitosamente";
    header("Location: login.php"); // Redirigir a la página de login o a otra página de éxito
    exit();
} else {
    $_SESSION['error'] = "Error al cambiar la contraseña";
    header("Location: login.php");
    exit();
}

// Cerrar conexión y liberar recursos
mysqli_close($conex);
?>
