<?php

//Conectarse a la base de datos
require_once 'db_connection.php';

//Verificar que se recibieron los datos post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //obtener y limpiar datos
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $contrasena_plana = $_POST['contrasena'];
    
    //hashing a la contraseña
    $contrasena_cifrada = password_hash($contrasena_plana, PASSWORD_DEFAULT);
    
    //usar prepared statement para evitar inyeccion sql
    $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (?, ?, ?)";
    
    try {

        $stmt = $pdo->prepare($sql);
        
        //ejecutar el insert de forma segura
        $stmt->execute([$nombre, $email, $contrasena_cifrada]);
        
        //redirigir al inicio de sesion
        header("Location: ../public/login.php?registro=exito");
        exit();
        
    } catch (PDOException $e) {

        //manejo del error de email ya existente clave unique
        if ($e->getCode() === '23000') {
            
            //redirigir al registro
            echo "Error: El correo electrónico ya está registrado. <a href='../registry.php'>Volver al registro</a>";

        } else {

            //error general de la base de datos
            echo "Error al registrar el usuario: " . $e->getMessage();
        }
    }
} else {

    //si se accede directamente al script, se redirige al formulario
    header("Location: ../public/registro.php");
    exit();
}
?>