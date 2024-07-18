<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="icon" type="icon/jpg" href="img/icon.jpg">
   <link rel="stylesheet" type="text/css" href="css/styleLogin.css">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  
   
   <title>Inicio de sesión</title>
</head>

<body>
<?php
session_start();
?>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 form-container">
        <img src="img/icon.jpg" alt="Perfil" class="profile-img">
        <form id="loginForm" action="verificarlogin.php" method="post">
          <h2 class="text-center">Iniciar Sesión</h2>
          <div class="form-group">
            <label for="username">Usuario</label>
            <input type="text" class="form-control" name="username" placeholder="Ingrese su usuario">
          </div>
          <div class="form-group password-container">
            <label for="password" class="w-100">Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="Ingrese su contraseña">
            <button type="button" class="btn btn-light toggle-password" id="togglePassword">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
              </svg>
              <svg id="eyeIconShow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye d-none" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
              </svg>
            </button>
          </div>
		  <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);
                }
                ?>
          <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
          <div class="text-center mt-3">
            <a href="#" id="showChangePassForm">Restablecer Contraseña</a>
          </div>
          <div class="text-center mt-3">
            <button type="button" class="btn btn-link" id="showRegisterForm">Crear Usuario</button>
          </div>
        </form>

        <form id="changePassForm"  action="cambiarpass.php" method="post" class="d-none">
          <h2 class="text-center">Restablecer Contraseña</h2>
          <div class="form-group">
            <label for="changeUsername">Usuario</label>
            <input type="text" class="form-control" name="dni" placeholder="Ingrese su usuario">
          </div>
           <div class="form-group password-container">
            <label for="password" class="w-100">Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="Ingrese su contraseña">
            <button type="button" class="btn btn-light toggle-password" id="togglePassword">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
              </svg>
              <svg id="eyeIconShow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye d-none" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
              </svg>
            </button>
          </div>
		   <?php
                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                        unset($_SESSION['error']);
                    }
                    if (isset($_SESSION['success'])) {
                        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success'] . '</div>';
                        unset($_SESSION['success']);
                    }
                    ?>
          <button type="submit" class="btn btn-primary btn-block">Crear nueva contraseña</button>
          <div class="text-center mt-3">
            <button type="button" class="btn btn-link" id="showLoginFormFromChangePass">Volver a Iniciar Sesión</button>
          </div>
        </form>

        <form id="registerForm" class="d-none" action="agregarlogin.php" method="post">
          <h2 class="text-center">Registro</h2>
          <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" name="dni" placeholder="Ingrese su DNI">
          </div>
          <div class="form-group">
            <label for="firstName">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Ingrese su nombre">
          </div>
          <div class="form-group">
            <label for="lastName">Apellido</label>
            <input type="text" class="form-control" name="apellido" placeholder="Ingrese su apellido">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Ingrese su email">
          </div>
		  <div class="form-group password-container">
            <label for="password" class="w-100">Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="Ingrese su contraseña">
            <button type="button" class="btn btn-light toggle-password" id="togglePassword">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
              </svg>
              <svg id="eyeIconShow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye d-none" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
              </svg>
            </button>
          </div>
		   <?php
                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                        unset($_SESSION['error']);
                    }
                    if (isset($_SESSION['success'])) {
                        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success'] . '</div>';
                        unset($_SESSION['success']);
                    }
                    ?>
          <button type="submit" class="btn btn-primary btn-block">Registrar</button>
          <div class="text-center mt-3">
            <button type="button" class="btn btn-link" id="showLoginFormFromRegister">Volver a Iniciar Sesión</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <video autoplay muted loop id="background-video">
    <source src="img/back.mp4" type="video/mp4">
    Tu navegador no soporta la etiqueta de video.
  </video>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#showRegisterForm').click(function() {
        $('#loginForm').addClass('d-none');
        $('#changePassForm').addClass('d-none');
        $('#registerForm').removeClass('d-none');
      });

      $('#showLoginForm').click(function() {
        $('#registerForm').addClass('d-none');
        $('#changePassForm').addClass('d-none');
        $('#loginForm').removeClass('d-none');
      });

      $('#showChangePassForm').click(function() {
        $('#loginForm').addClass('d-none');
        $('#registerForm').addClass('d-none');
        $('#changePassForm').removeClass('d-none');
      });

      $('#showLoginFormFromRegister').click(function() {
        $('#registerForm').addClass('d-none');
        $('#changePassForm').addClass('d-none');
        $('#loginForm').removeClass('d-none');
      });

      $('#showLoginFormFromChangePass').click(function() {
        $('#registerForm').addClass('d-none');
        $('#changePassForm').addClass('d-none');
        $('#loginForm').removeClass('d-none');
      });

      $('.toggle-password').click(function() {
        const input = $(this).siblings('input');
        const eyeIcon = $(this).find('#eyeIcon');
        const eyeIconShow = $(this).find('#eyeIconShow');
        const inputType = input.attr('type') === 'password' ? 'text' : 'password';
        input.attr('type', inputType);
        eyeIcon.toggleClass('d-none');
        eyeIconShow.toggleClass('d-none');
      });
    });
  </script>
</body>

</html>