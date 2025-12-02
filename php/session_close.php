<?php
session_start();      // Iniciar sesión para poder destruirla
session_unset();      // Eliminar todas las variables de sesión
session_destroy();    // Destruir la sesión actual

// Redirigir al login o a la página principal
header("Location: ../public/login.php");
exit();
?>