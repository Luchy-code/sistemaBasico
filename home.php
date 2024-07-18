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
   <title>Home</title>
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
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$sql = "SELECT img FROM empleados WHERE dni = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if ($resultado) {
    // Verificar si se encontró un resultado
    if (mysqli_num_rows($resultado) > 0) {
        // Obtener la fila de resultados
        $fila = mysqli_fetch_assoc($resultado);

        // Obtener la imagen en base64 (suponiendo que la imagen se almacena como datos binarios en la base de datos)
        $imagenBase64 = base64_encode($fila['img']);
    } else {
        echo "No se encontró ninguna imagen para el usuario con DNI $id_usuario.";
        $imagenBase64 = ''; // Asignar una cadena vacía si no se encuentra imagen
    }
} else {
    echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    $imagenBase64 = ''; // Asignar una cadena vacía en caso de error
}

// Liberar el resultado
mysqli_free_result($resultado);

// Cerrar la conexión
mysqli_close($conn);
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
      <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0"/>
</svg></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
         <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true" href="home.php" style="margin: 10px;"><?php echo $nombre_usuario . " (" . $id_usuario . ")"; ?></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin: 10px;">
            Mas
          </a>
          <ul class="dropdown-menu">
            <a class="dropdown-item" href="registrarVenta.php">Ventas</a>
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="ordenarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ordenar
                        </a>
                        <div class="dropdown-menu" aria-labelledby="ordenarDropdown">
                            <a class="dropdown-item" href="?orderBy=abc">ABC</a>
                            <a class="dropdown-item" href="?orderBy=cba">CBA</a>
                            <a class="dropdown-item" href="?orderBy=mas-caro">Más caro</a>
                            <a class="dropdown-item" href="?orderBy=menos-caro">Menos caro</a>
                            <a class="dropdown-item" href="?orderBy=mas-cantidad">Más cantidad</a>
                            <a class="dropdown-item" href="?orderBy=menos-cantidad">Menos cantidad</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#formCollapse"
                            aria-expanded="false" aria-controls="formCollapse">
                            Agregar artículo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="download_csv.php">Descargar CSV</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div class="collapse" id="formCollapse">
  <div class="card card-body">
    <form action="agregarArtic.php" method="post" style="width: 45%; align-self: center; background-color:#FEFCC1; padding:20px;">
        <div class="form-group">
		<label for="id">ID producto:</label>
        <input type="number" class="form-control"  id="id" name="id" required>
		</div>
	 <div class="form-group">
        <label for="nombre">Nombre:</label>
		<input type="text" class="form-control" id="nombre" name="nombre" required>
      </div>
	  <div class="form-group">
        <label for="tipo">Tipo:</label>
		<input type="text" class="form-control" id="tipo" name="tipo" required>
      </div>
	  <div class="form-group">
        <label for="marca">Marca:</label>
		<input type="text" class="form-control" id="marca" name="marca" required>
      </div>
	 <div class="form-group">
		<label for="precio">Precio:</label>
        <input type="number" class="form-control" id="precio" name="precio" min="1"  required>
	</div>
        <div  class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" id="cant" name="cant" min="1" required>

        </div>
        <button type="submit" id="agregarArticulo"class="form-control">Agregar</button>
    </form>
 </div>
</div>

<script>
document.getElementById('addArticleForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar que se envíe el formulario de la forma tradicional

    var formData = new FormData(this);

    fetch('agregarArtic.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        var messageContainer = document.getElementById('messageContainer');
        messageContainer.style.display = 'block';
        messageContainer.innerHTML = data.message;
        messageContainer.style.backgroundColor = data.success ? 'green' : 'red';
    })
    .catch(error => console.error('Error:', error));
});
</script>
	
	
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
        $sql = "SELECT id, nombre, tipo, marca, precio, cant FROM articulos 
                WHERE nombre LIKE '%$busqueda%' OR tipo LIKE '%$busqueda%' OR marca LIKE '%$busqueda%' OR id LIKE '%$busqueda%'
                ORDER BY nombre ASC";
    } else {
        switch ($orderBy) {
            case 'abc':
                $sql = "SELECT id, nombre, tipo, marca, precio, cant FROM articulos ORDER BY nombre ASC";
                break;
            case 'cba':
                $sql = "SELECT id, nombre, tipo, marca, precio, cant FROM articulos ORDER BY nombre DESC";
                break;
            case 'mas-caro':
                $sql = "SELECT id, nombre, tipo, marca, precio, cant FROM articulos ORDER BY precio DESC";
                break;
            case 'menos-caro':
                $sql = "SELECT id, nombre, tipo, marca, precio, cant FROM articulos ORDER BY precio ASC";
                break;
            case 'mas-cantidad':
                $sql = "SELECT id, nombre, tipo, marca, precio, cant FROM articulos ORDER BY cant DESC";
                break;
            case 'menos-cantidad':
                $sql = "SELECT id, nombre, tipo, marca, precio, cant FROM articulos ORDER BY cant ASC";
                break;
            default:
                $sql = "SELECT id, nombre, tipo, marca, precio, cant FROM articulos";
        }
    }

    // Ejecutar la consulta y mostrar los resultados
    $result = mysqli_query($conex, $sql);
 if (mysqli_num_rows($result) > 0) {
        echo "<table class='table-secondary table table-hover' id='table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
		echo "<th style='width: 15%;'>Acción</th>";
        echo "<th>Nombre</th>";
        echo "<th>Tipo</th>";
        echo "<th>Marca</th>";
        echo "<th>Precio</th>";
        echo "<th>Cantidad</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
			echo "<td>";
// Botón de eliminar
echo "<button type='button' style='margin: 10px;' class='btn btn-outline-danger delete-button' data-item-id='" . $row['id'] . "'>";
echo "<svg xmlns='http://www.w3.org/2000/svg' width='40'  height='16' fill='currentColor' class='bi bi-x-circle' viewBox='0 0 16 16'>";
echo "<path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16'/>";
echo "<path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708'/>";
echo "</svg>";
echo "</button>";

// Botón de edición
echo "<button type='button'  style='margin: 10px;' class='btn btn-outline-warning edit-button' data-item-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#editProductModal'>";
echo "<svg xmlns='http://www.w3.org/2000/svg' width='40' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>";
echo "<path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>";
echo "</svg>";
echo "</button>";

echo "</td>";

            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['tipo'] . "</td>";
            echo "<td>" . $row['marca'] . "</td>";
            echo "<td>" . $row['precio'] . "</td>";
            echo "<td>" . $row['cant'] . "</td>";
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

<br>
</div>

<!-- Modal para el formulario de edición -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición -->
                <form id="editProductForm">
                    <input type="hidden" id="editProductId" name="id">
                    <div class="mb-3">
                        <label for="editProductName" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="editProductName" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductTipo" class="form-label">Tipo del Producto</label>
                        <input type="text" class="form-control" id="editProductTipo" name="tipo" required>
                    </div>
					<div class="mb-3">
                        <label for="editProductMarca" class="form-label">Marca del Producto</label>
                        <input type="text" class="form-control" id="editProductMarca" name="marca" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductPrecio" class="form-label">Precio del Producto</label>
                        <input type="number" class="form-control" id="editProductPrecio" name="precio" min="0.01" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductCantidad" class="form-label">Cantidad del Producto</label>
                        <input type="number" class="form-control" id="editProductCantidad" name="cant" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    $('.edit-button').click(function() {
        var productId = $(this).data('item-id');
        var url = 'editar_producto.html?id=' + productId;
        var windowFeatures = "width=600,height=400,scrollbars=yes";
        window.open(url, "Editar Producto", windowFeatures);
    });
});
</script>


<!-- Modal para contraseña -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="passwordModalLabel">Confirmar Eliminación</h5>
		</script>
     </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
              window.location.href = `delete_item.php?id=${itemId}`;
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

</body>
</html>
