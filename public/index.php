<?php

session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Página Principal</title>
</head>
<body>
    <?php if (isset($_SESSION['user_nombre'])): ?>
        <h1>¡Hola, <?php echo htmlspecialchars($_SESSION['user_nombre']); ?>!</h1>
        
        <a href="../handlers/logout.php">Cerrar Sesión</a>
    <?php else: ?>
        <h1>Bienvenido a la Web</h1>
        <p>Por favor, <a href="./login.php">inicia sesión</a> o <a href="./registry.php">regístrate</a>.</p>
    <?php endif; ?>
</body>
</html>