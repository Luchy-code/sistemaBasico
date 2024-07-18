<?php
// Establecer conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";
$conex = mysqli_connect($server, $user, $pass, $bd);

// Verificar conexión
if (!$conex) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

// Recibir datos del formulario
$id_venta = $_POST['id_venta'];
$id_cliente = $_POST['id_cliente'];
$cel_cliente = $_POST['cel_cliente'];
$metodo_pago = $_POST['metodo_pago'];
$id_vendedor = $_POST['id_vendedor'];
$productos = $_POST['productos']; // Array de productos

// Iniciar transacción
mysqli_autocommit($conex, false);

// Insertar datos en la tabla `ventas`
$fecha = date('Y-m-d H:i:s'); // Fecha y hora actual
$total = 0; // Calcular el total sumando el precio_unitario * cantidad de cada producto

$insert_venta = "INSERT INTO ventas (id, fecha, dni_cliente, total, metodo_pago, dni_vendedor)
                 VALUES (?, ?, ?, ?, ?, ?)";
$stmt_venta = $conex->prepare($insert_venta);

// Verificar que $stmt_venta se haya preparado correctamente
if ($stmt_venta === false) {
    die("Error en la preparación de la consulta: " . $conex->error);
}

$stmt_venta->bind_param("issdsi", $id_venta, $fecha, $id_cliente, $total, $metodo_pago, $id_vendedor);
$stmt_venta->execute();

if ($stmt_venta->affected_rows === 1) {
    // Insertar datos en la tabla `detalle_ventas` para cada producto
    $insert_detalle = "INSERT INTO detalle_ventas (id_venta, id_producto, cantidad, precio_unitario)
                       VALUES (?, ?, ?, ?)";
    $stmt_detalle = $conex->prepare($insert_detalle);

    // Verificar que $stmt_detalle se haya preparado correctamente
    if ($stmt_detalle === false) {
        mysqli_rollback($conex);
        die("Error en la preparación de la consulta de detalle: " . $conex->error);
    }

    foreach ($productos as $producto) {
        $id_producto = $producto['id_producto'];
        $cantidad = $producto['cantidad'];

        // Obtener el precio_unitario y la cantidad disponible del producto desde la tabla `articulos`
        $consulta_producto = "SELECT precio, cant FROM articulos WHERE id = ?";
        $stmt_producto = $conex->prepare($consulta_producto);
        $stmt_producto->bind_param("i", $id_producto);
        $stmt_producto->execute();
        $resultado_producto = $stmt_producto->get_result();

        if ($resultado_producto->num_rows === 1) {
            $producto_info = $resultado_producto->fetch_assoc();
            $precio_unitario = $producto_info['precio'];
            $cantidad_disponible = $producto_info['cant'];

            // Verificar si hay suficiente stock disponible
            if ($cantidad_disponible >= $cantidad) {
                // Restar la cantidad vendida del stock
                $nuevo_stock = $cantidad_disponible - $cantidad;

                // Actualizar el stock en la tabla `articulos`
                $actualizar_stock = "UPDATE articulos SET cant = ? WHERE id = ?";
                $stmt_actualizar_stock = $conex->prepare($actualizar_stock);
                $stmt_actualizar_stock->bind_param("ii", $nuevo_stock, $id_producto);
                $stmt_actualizar_stock->execute();

                if ($stmt_actualizar_stock->affected_rows === 1) {
                    // Insertar el detalle de la venta
                    $stmt_detalle->bind_param("iiid", $id_venta, $id_producto, $cantidad, $precio_unitario);
                    $stmt_detalle->execute();

                    if ($stmt_detalle->affected_rows !== 1) {
                        // Si hay algún error, revertir la transacción
                        mysqli_rollback($conex);
                        die("Error al insertar detalle de la venta: " . $stmt_detalle->error);
                    }

                    // Calcular el total sumando el precio_unitario * cantidad de cada producto
                    $total += $precio_unitario * $cantidad;
                } else {
                    // Si hay algún error, revertir la transacción
                    mysqli_rollback($conex);
                    die("Error al actualizar el stock del producto: " . $stmt_actualizar_stock->error);
                }
            } else {
                // Si no hay suficiente stock, revertir la transacción
                mysqli_rollback($conex);
                die("Stock insuficiente para el producto ID: $id_producto");
            }
        } else {
            // Si no se encuentra el producto, revertir la transacción
            mysqli_rollback($conex);
            die("Producto no encontrado con ID: $id_producto");
        }

        $stmt_producto->close();
    }

    // Actualizar el total en la venta
    $update_total = "UPDATE ventas SET total = ? WHERE id = ?";
    $stmt_update = $conex->prepare($update_total);
    $stmt_update->bind_param("di", $total, $id_venta);
    $stmt_update->execute();

    if ($stmt_update->affected_rows !== 1) {
        // Si hay algún error, revertir la transacción
        mysqli_rollback($conex);
        die("Error al actualizar el total de la venta: " . $stmt_update->error);
    }

    // Confirmar la transacción si todo está bien
    mysqli_commit($conex);

    // Cerrar las consultas preparadas
    $stmt_venta->close();
    $stmt_detalle->close();
    $stmt_update->close();

    // Cerrar la conexión
    $conex->close();

    // Redirigir o mostrar mensaje de éxito
    echo "Venta registrada correctamente.";
    // Puedes redirigir al usuario a otra página o mostrar un mensaje de éxito aquí
} else {
    // Si hay algún error, revertir la transacción
    mysqli_rollback($conex);
    die("Error al insertar la venta: " . $stmt_venta->error);
}
?>
