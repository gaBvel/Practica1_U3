<?php
?>
<!doctype html>
<html lang="es">
    
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Inicio de sesion</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <main class="main" role="main">

        <h1>Inicio de sesion</h1>
        <form id="contactForm" action="../php/process_login.php" method="POST">

            <div>
                <label for="email">Correo electrónico</label>
                <input id="email" name="email" type="email" required placeholder="ejemplo@gmail.com" required> <br>
            </div>

            <div>
                <label for="contrasena">Contraseña</label>
                <input id="password" name="contrasena" type="contrasena" required/> <br>
            </div>

            <div>
                <input type="submit" value="Acceder">
                <p>¿No tienes cuenta? <a href="./registry.php">Registrate aqui</a></p>
            </div>

            
        </form>
    </main>
</body>
</html>
