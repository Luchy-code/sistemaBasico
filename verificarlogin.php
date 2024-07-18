<?php
session_start();
$server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";
$conex = mysqli_connect($server, $user, $pass, $bd);

$usuario = $_POST['username'];
$clave = $_POST['password'];

$_SESSION['usuario'] = $usuario;

// Verificar si el usuario existe
$consultaUsuario = "SELECT * FROM `empleados` WHERE dni='$usuario'";
$resultadoUsuario = mysqli_query($conex, $consultaUsuario);

if ($resultadoUsuario && mysqli_num_rows($resultadoUsuario) > 0) {
    $fila = mysqli_fetch_assoc($resultadoUsuario);
    if ($clave == $fila['pass']) { // Verifica la contraseña sin hashear, usa `password_verify` si la contraseña está hasheada

        $consultaNombre="SELECT nombre FROM `empleados` WHERE dni='$usuario'";
        $resultadoNombre = mysqli_query($conex, $consultaNombre);
        $datos_usuario = mysqli_fetch_assoc($resultadoNombre);
        $_SESSION['nombre_usuario'] = $datos_usuario['nombre']; // Guardar el nombre del usuario en sesión
        $_SESSION['id_usuario'] = $usuario; // Guardar el id del usuario en sesión
        $_SESSION['user_password'] = $fila['pass']; // Guardar la contraseña del usuario en sesión
        header("Location: home.php");
        exit();
    } else {
        $_SESSION['error'] = "Contraseña incorrecta";
    }
} else {
    $_SESSION['error'] = "Usuario no encontrado";
}

mysqli_free_result($resultadoUsuario);
mysqli_close($conex);

header("Location: login.php"); // Redirige de vuelta al formulario de inicio de sesión
exit();
?>

?>
