<?php
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Formulario</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <main class="main" role="main">

        <h1>Formulario</h1>
        <form id="contactForm" action="../php/process_registry.php" method="POST">

            <div>
                <label for="name">Nombre completo</label>
                <input id="name" name="name" type="text" required minlength="2" placeholder="Nombre" required> <br>
            </div>

            <div>
                <label for="email">Correo electrónico</label>
                <input id="email" name="email" type="email" required placeholder="ejemplo@gmail.com" required> <br>
            </div>

            <div>
                <label for="contrasena">Contraseña</label>
                <input id="password" name="contrasena" type="contrasena" required/> <br>
            </div>

            <div>
                <input type="submit" value="Crear Cuenta">
                <p>¿Ya tienes cuenta? <a href="./login.php">Inicia sesion aqui</a></p>
            </div>

            
        </form>
    </main>
</body>
</html>
