<?php
// Conectar a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";
$conex = mysqli_connect($server, $user, $pass, $bd);

if (!$conex) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

// Obtener los datos de la base de datos
$query = "SELECT * FROM articulos"; // Ajusta esta consulta según tu tabla
$result = mysqli_query($conex, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conex));
}

// Crear un archivo temporal
$filename = 'articulos_' . date('Ymd') . '.csv';
$temp_file = fopen('php://output', 'w');

// Configurar encabezados para forzar descarga
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');

// Escribir encabezados de las columnas
$columns = ['ID', 'Nombre', 'Marca', 'Precio', 'Cantidad']; // Ajusta según tus columnas
fputcsv($temp_file, $columns);

// Escribir datos
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($temp_file, $row);
}

// Cerrar el archivo temporal
fclose($temp_file);

// Cerrar conexión a la base de datos
mysqli_close($conex);

exit();
?>
