<?php
if (isset($_GET['password']) && isset($_GET['stored_password'])) {
    $inputPassword = $_GET['password'];
    $storedPassword = $_GET['stored_password'];

    // Verificar la contraseña
    if ($inputPassword === $storedPassword) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Faltan parámetros']);
}
?>
