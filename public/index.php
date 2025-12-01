<?php

session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Página Principal</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styles2.css">
</head>
<body>
    <main>
        <div class="container-index">
            <?php if (isset($_SESSION['user_nombre'])): ?>
                <h1>¡Bienvenido!</h1>
                <div class="user-box">
                    <p class="welcome-text">
                        <h1>¡Hola, <?php echo htmlspecialchars($_SESSION['user_nombre']); ?>!</h1>
                    </p>
                    <div class="buttons-index">
                        <a href="../handlers/logout.php">Cerrar Sesión</a>
                    </div>
                </div>
            <?php else: ?>
                <h1>Bienvenido a la Web</h1>
                <p class="welcome-text">
                    <p>Por favor, Inicia sesión o Regístrate</p>
                </p>

                <div class="buttons-index">
                    <a class="button-link" href="./login.php">Iniciar sesión</a>
                    <a class="button-link" href="./registry.php">Registrarse</a>
                </div>
            <?php endif; ?>
        </div>
    </main> 
</body>
</html>