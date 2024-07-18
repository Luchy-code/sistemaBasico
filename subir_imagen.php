<?php
// Iniciar sesión si aún no está iniciada
session_start();

// Obtener el ID de usuario desde el formulario
if (isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];

    // Verificar si se subió un archivo
    if (isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] == 0) {
        // Obtener la información del archivo
        $fileTmpPath = $_FILES['imageFile']['tmp_name'];
        $fileName = $_FILES['imageFile']['name'];
        $fileSize = $_FILES['imageFile']['size'];
        $fileType = $_FILES['imageFile']['type'];

        // Leer el contenido del archivo y codificarlo en base64
        $imageBase64 = base64_encode(file_get_contents($fileTmpPath));

        // Crear la cadena para el campo img en la base de datos
        $image = 'data:' . $fileType . ';base64,' . $imageBase64;

        // Conectar a la base de datos y actualizar la imagen del usuario
       $server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";
$conn = mysqli_connect($server, $user, $pass, $bd);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Actualizar la imagen del usuario en la base de datos
        $sql = "UPDATE empleados SET img = '$image' WHERE dni = $id_usuario";

        if ($conn->query($sql) === TRUE) {
            header("Location: home.php");
        exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Error al subir el archivo.";
    }
} else {
    echo "ID de usuario no recibido.";
}
?>
