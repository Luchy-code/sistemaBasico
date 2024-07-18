<?php
session_start();
$server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";
$conex = mysqli_connect($server, $user, $pass, $bd);

$defaultImagePath = 'img/perfil.png';

// Leer el contenido de la imagen y codificarlo en base64
$defaultImage = 'data:image/png;base64,' . base64_encode(file_get_contents($defaultImagePath));


$usuario = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$clave = $_POST['password'];

$_SESSION['usuario'] = $usuario;

if (strlen($usuario) >= 1 && strlen($clave) >= 1 && strlen($nombre) >= 1 && strlen($apellido) >= 1 && strlen($email) >= 1){
    $consultaUsuario = "SELECT * FROM `empleados` WHERE dni='$usuario'";
    $resultadoUsuario = mysqli_query($conex, $consultaUsuario);

    if (mysqli_num_rows($resultadoUsuario) > 0) {
        $_SESSION['error'] = "Usuario ya existe";
        header("Location: login.php");
        exit();
    }
	
	$consultaEmail = "SELECT * FROM `empleados` WHERE email='$email'";
	$resultadoEmail = mysqli_query($conex, $consultaEmail);

	if (mysqli_num_rows($resultadoEmail) > 0) {
    $_SESSION['error'] = "Email ya existe";
    header("Location: login.php");
    exit();
	}

    $consulta = "INSERT INTO `empleados`(`dni`, `img`, `nombre`, `apellido`, `email`, `pass`) VALUES ('$usuario', '$defaultImage', '$nombre', '$apellido', '$email', '$clave')";
    $resultado = mysqli_query($conex, $consulta);
    
    if ($resultado) {
        $_SESSION['success'] = "Usuario registrado exitosamente";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Error al registrar el usuario";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Algún campo está vacío";
    header("Location: login.php");
    exit();
}

mysqli_close($conex);
?>
