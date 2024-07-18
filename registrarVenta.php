<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Incluir Bootstrap JS (incluye Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>

   <link rel="icon" type="icon/jpg" href="img/icon.jpg">
   <link rel="stylesheet" type="text/css" href="css/styleHome.css">
   <title>Ventas</title>
</head>

<?php
// Iniciar sesión si no está iniciada
session_start();
$nombre_usuario = $_SESSION['nombre_usuario'];
$id_usuario = $_SESSION['id_usuario'];

// Conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";
$conn = mysqli_connect($server, $user, $pass, $bd);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener la imagen del usuario
$sql = "SELECT img FROM empleados WHERE dni = $id_usuario";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}

// Obtener la imagen del usuario
$image = 'img/perfil.png'; // Imagen predeterminada
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['img'])) {
        $image = $row['img'];
    }
}

$conn->close();
?>
<body>
<br>
<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:white;">
  <div class="container-fluid">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <!-- Imagen de perfil con clase 'avatar' -->
        <img src="data:image/jpeg;base64,<?php echo $imagenBase64; ?>" class="avatar rounded-circle" alt="Avatar Image"
            style="width: 50px; height: 50px; margin-right: 0px; padding: 0px;">
                        </a>
						<ul class="dropdown-menu">
		   <form action="subir_imagen.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                                <label for="imageFile">Seleccionar imagen:</label>
                                <input type="file" name="imageFile" id="imageFile" accept=".jpg, .jpeg, .png">
                                <button type="submit">Subir Imagen</button>
                            </form>
          </ul>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
</svg></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
         <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true" href="registrarVenta.php" style="margin: 10px;"><?php echo $nombre_usuario . " (" . $id_usuario . ")"; ?></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin: 10px;">
            Mas
          </a>
          <ul class="dropdown-menu">
            <a class="dropdown-item" href="home.php">Home</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="login.php">Salir</a>
          </ul>
        </li>
        <form class="form-inline my-2 my-lg-0" id="searchForm" method="POST" action="home.php">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar..." aria-label="Search"
                    name="busqueda" id="buscar">
                <button class="btn btn-outline-warning my-2 my-sm-0" type="submit" id="buscarBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-binoculars" viewBox="0 0 16 16">
                        <path
                            d="M3 2.5A1.5 1.5 0 0 1 4.5 1h1A1.5 1.5 0 0 1 7 2.5V5h2V2.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5v2.382a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V14.5a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 14.5v-3a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5v3A1.5 1.5 0 0 1 5.5 16h-3A1.5 1.5 0 0 1 1 14.5V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882zM4.5 2a.5.5 0 0 0-.5.5V3h2v-.5a.5.5 0 0 0-.5-.5zM6 4H4v.882a1.5 1.5 0 0 1-.83 1.342l-.894.447A.5.5 0 0 0 2 7.118V13h4v-1.293l-.854-.853A.5.5 0 0 1 5 10.5v-1A1.5 1.5 0 0 1 6.5 8h3A1.5 1.5 0 0 1 11 9.5v1a.5.5 0 0 1-.146.354l-.854.853V13h4V7.118a.5.5 0 0 0-.276-.447l-.895-.447A1.5 1.5 0 0 1 12 4.882V4h-2v1.5a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5zm4-1h2v-.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm4 11h-4v.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zm-8 0H2v.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5z" />
                    </svg>
                </button>
            </form>
      </ul>
     
    </div>
  </div>
</nav>

<br>
<div id="tabla">
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="ordenarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Ordenar
  </a>
  <div class="dropdown-menu" aria-labelledby="ordenarDropdown">
    <a class="dropdown-item" href="?orderBy=mas-caro">Mas caro</a>
    <a class="dropdown-item" href="?orderBy=menos-caro">Menos caro</a>
    <a class="dropdown-item" href="?orderBy=mas-nuevo">Mas nuevo</a>
    <a class="dropdown-item" href="?orderBy=menos-nuevo">Menos nuevo</a>
  </div>
</li>
<script>
$(document).ready(function() {
  $('.dropdown-item').click(function(event) {
    event.preventDefault();
    const order = $(this).data('order');
    console.log(`Ordenar por: ${order}`);

    $.ajax({
      url: 'obtener_ventas.php', // Cambia a la ruta correcta de tu script PHP
      type: 'GET',
      data: { order: order },
      success: function(response) {
        $('#table tbody').html(response); // Actualiza el cuerpo de la tabla con los nuevos datos
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error en la petición AJAX:', textStatus, errorThrown);
      }
    });
  });
});

</script>
<li class="nav-item">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#formCollapse" aria-expanded="false" aria-controls="formCollapse">
            Agregar venta
          </a>
        </li>
		 <li class="nav-item">
          <a class="nav-link" href="download_ventas_csv.php" class="btn btn-primary">Descargar SCV</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
$server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";
$conex = mysqli_connect($server, $user, $pass, $bd);

if (!$conex) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener el ID de la última venta
$sql_ultima_venta = "SELECT id FROM ventas ORDER BY id DESC LIMIT 1";
$resultado = mysqli_query($conex, $sql_ultima_venta);
$row = mysqli_fetch_assoc($resultado);
$id_ultima_venta = $row ? $row['id'] : 0;
$id_nueva_venta = $id_ultima_venta + 1;

?>

<div class="collapse" id="formCollapse">
  <div class="card card-body">
    <form action="agregarVenta.php" method="post" style="width: 45%; align-self: center; background-color:#FEFCC1; padding:20px;">
        <div class="form-group">
		<label for="id_venta">ID venta:</label>
        <input class="form-control"  id="id_venta" name="id_venta" value="<?php echo $id_nueva_venta; ?>">
		</div>
	 <div class="form-group">
        <label for="id_cliente">ID Cliente:</label>
		<input type="text" class="form-control" id="id_cliente" name="id_cliente" max='9' required>
      </div>
	  <div class="form-group">
        <label for="id_cliente">Cel Cliente:</label>
		<input type="text" class="form-control" id="cel_cliente" name="cel_cliente" required>
      </div>
		<div class="form-group">
        <label for="metodo_pago">Método de Pago:</label>
        <select id="metodo_pago" name="metodo_pago" required>
            <option value="credito">Crédito</option>
            <option value="debito">Débito</option>
            <option value="efectivo">Efectivo</option>
        </select>
		</div>
	 <div class="form-group">
		<label for="id_vendedor">ID empleado:</label>
        <input class="form-control" id="id_vendedor" name="id_vendedor" value="<?php echo $id_usuario; ?>">
	</div>
        <div id="productos" class="form-group">
            <div class="producto">
                <label for="id_producto">ID Producto:</label>
                <input type="number" name="productos[0][id_producto]" required>
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="productos[0][cantidad]" min="1" required>
            </div>
        </div>

        <button type="button" onclick="agregarProducto()">Agregar Producto</button>
        <button type="submit" id="registrarVenta">Registrar Venta</button>
    </form>
 </div>
</div>

<script>
let contadorProductos = 1;

function agregarProducto() {
    const productosDiv = document.getElementById('productos');
    const nuevoProductoDiv = document.createElement('div');
    nuevoProductoDiv.classList.add('producto', 'form-group');
    nuevoProductoDiv.innerHTML = `
        <label for="id_producto">ID Producto:</label>
        <input type="number" name="productos[${contadorProductos}][id_producto]" class="form-control" required>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="productos[${contadorProductos}][cantidad]" class="form-control" min="1" required>
        <button type="button" class="btn btn-danger mt-2" onclick="eliminarProducto(this)">Eliminar Producto</button>
    `;
    productosDiv.appendChild(nuevoProductoDiv);
    contadorProductos++;
}

function eliminarProducto(button) {
    button.parentElement.remove();
}

$(document).ready(function() {
    $(".dropdown-item").click(function() {
        var order = $(this).data("order");
        console.log("Ordenar por: " + order);
    });

    $('form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: 'agregarVenta.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert('Venta registrada exitosamente');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error al registrar la venta:', status, error);
                alert('Error al registrar la venta. Por favor, intenta nuevamente.');
            }
        });
    });
});
</script>

<?php
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_SESSION['error']) . '</div>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['success']) . '</div>';
    unset($_SESSION['success']);
}
?>


<?php
// Conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$bd = "panol";

// Conectar a la base de datos
$conex = mysqli_connect($server, $user, $pass, $bd);

// Verificar la conexión
if (!$conex) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener el criterio de ordenamiento o término de búsqueda
$orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : '';
$busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';

// Construir la consulta SQL según el criterio seleccionado o la búsqueda realizada
if (!empty($busqueda)) {
    $busqueda = mysqli_real_escape_string($conex, $busqueda);
    $sql = "SELECT id, fecha, dni_cliente, dni_vendedor, total FROM ventas 
            WHERE dni_cliente LIKE '%$busqueda%' OR dni_vendedor LIKE '%$busqueda%' OR metodo_pago LIKE '%$busqueda%' OR id LIKE '%$busqueda%' OR fecha LIKE '%$busqueda%'
            ORDER BY id ASC";
} else {
    switch ($orderBy) {
        case 'mas-caro':
            $sql = "SELECT id, fecha, dni_cliente, dni_vendedor, total FROM ventas ORDER BY total DESC";
            break;
        case 'menos-caro':
            $sql = "SELECT id, fecha, dni_cliente, dni_vendedor, total FROM ventas ORDER BY total ASC";
            break;
        case 'mas-nuevo':
            $sql = "SELECT id, fecha, dni_cliente, dni_vendedor, total FROM ventas ORDER BY fecha DESC";
            break;
        case 'menos-nuevo':
            $sql = "SELECT id, fecha, dni_cliente, dni_vendedor, total FROM ventas ORDER BY fecha ASC";
            break;
        default:
            $sql = "SELECT id, fecha, dni_cliente, total, metodo_pago, dni_vendedor FROM ventas";
    }
}

// Ejecutar la consulta y verificar errores
$result = mysqli_query($conex, $sql);

if ($result === false) {
    die("Error en la consulta SQL: " . mysqli_error($conex));
}

// Mostrar los resultados
if (mysqli_num_rows($result) > 0) {
    echo "<table class='table table-hover' id='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th style='width: 5%;'>Acción</th>";
    echo "<th>Fecha</th>";
    echo "<th>Cliente</th>";
    echo "<th>Empleado</th>";
    echo "<th>Precio</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>";
        // Botón de eliminar
        echo "<button type='button' class='btn btn-outline-danger delete-button' data-item-id='" . $row['id'] . "'>";
        echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-circle' viewBox='0 0 16 16'>";
        echo "<path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16'/>";
        echo "<path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708'/>";
        echo "</svg>";
        echo "</button>";
        echo "</td>";
        echo "<td>" . $row['fecha'] . "</td>";
        echo "<td>" . $row['dni_cliente'] . "</td>";
        echo "<td>" . $row['dni_vendedor'] . "</td>";
        echo "<td>" . $row['total'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p class='alert alert-warning'>No se encontraron resultados.</p>";
}

// Cerrar la conexión
mysqli_close($conex);
?>
<br>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', function() {
      const itemId = this.getAttribute('data-item-id');
      Swal.fire({
        title: 'Ingresa tu contraseña',
        input: 'password',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Ingresar',
        showLoaderOnConfirm: true,
        preConfirm: (password) => {
          // Obtener la contraseña almacenada en la sesión desde PHP
          const storedPassword = "<?php echo $_SESSION['user_password']; ?>";
          return fetch(`verify_password.php?password=${password}&stored_password=${storedPassword}`)
            .then(response => {
              if (!response.ok) {
                throw new Error(response.statusText);
              }
              return response.json();
            })
            .then(data => {
              if (!data.success) {
                throw new Error(data.message);
              }
              return data;
            })
            .catch(error => {
              Swal.showValidationMessage(
                `Request failed: ${error}`
              );
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Estas seguro?',
            text: "No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              // Realizar la eliminación
              window.location.href = `eliminar_venta.php?id=${itemId}`;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              Swal.fire(
                'Cancelado',
                'Tu ítem está a salvo :)',
                'error'
              );
            }
          });
        }
      });
    });
  });
});
</script>





<br>
<footer>Gracias por trabajar con nosotros</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
