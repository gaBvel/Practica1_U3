<?php

//iniciar sesion
session_start(); 

//Conectarse a la base de datos
require_once 'db_connection.php';

//Verificar que se recibieron los datos post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //obtener y limpiar los datos
    $email = trim($_POST['email']);
    $contrasena_ingresada = $_POST['contrasena'];
    
    //buscar el usuario por el correo pues algo que puede ser unico 
    $sql = "SELECT id, nombre, contrasena FROM usuarios WHERE email = ?";
    
    try {

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(); 
        
        //verificar usuario y contraseña
        if ($usuario) {

            //verificar la contraseña: compara la contraseña en texto plano con el hash guardado
            if (password_verify($contrasena_ingresada, $usuario['contrasena'])) {
                
                //guardar datos de sesion
                $_SESSION['user_id'] = $usuario['id'];
                $_SESSION['user_nombre'] = $usuario['nombre'];
                
                //redirigir a la pagina principal
                header("Location: ../public/index.php"); 
                exit();
                
            } else {

                //la contraseña no es correcta
                $error = "Contraseña incorrecta";

            }
        } else {

            //el email no se encontro
            $error = "El correo electronico no esta registrado";

        }
        
    } catch (PDOException $e) {

        $error = "Error en el servidor: " . $e->getMessage();

    }
} else {

    //si se accede directamente al script
    $error = "Acceso no permitido.";

}

//si hay un error see edirige al login con un mensaje (o muestra el error)
if (isset($error)) {

    echo "<h2>Error de inicio de sesion</h2>";
    echo "<p>$error</p>";
    echo "<a href='../public/login.php'>Intentar de nuevo</a>";

}

?>