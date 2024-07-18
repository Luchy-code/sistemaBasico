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

// Consulta SQL para unir las tablas ventas y detalle_ventas
$query = "
    SELECT 
        v.id AS venta_id, 
        v.fecha, 
        v.dni_cliente, 
        v.total, 
        v.metodo_pago, 
        v.dni_vendedor,
        dv.id AS detalle_id, 
        dv.id_producto, 
        dv.cantidad, 
        dv.precio_unitario
    FROM ventas v
    LEFT JOIN detalle_ventas dv ON v.id = dv.id_venta
";
$result = mysqli_query($conex, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conex));
}

// Crear un archivo temporal
$filename = 'ventas_' . date('Ymd') . '.csv';
$temp_file = fopen('php://output', 'w');

// Configurar encabezados para forzar descarga
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');

// Escribir encabezados de las columnas
$columns = ['Venta ID', 'Fecha', 'DNI Cliente', 'Total', 'Método de Pago', 'DNI Vendedor', 'Detalle ID', 'ID Producto', 'Cantidad', 'Precio Unitario'];
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
