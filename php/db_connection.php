<?php


$host = 'localhost';
$db_name = 'registro_bd';
$user = 'root'; 
$pass = ''; 
$charset = 'utf8mb4';

$dsn_server = "mysql:host=$host;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     // Conexion al servidor mysql
     $pdo_server = new PDO($dsn_server, $user, $pass, $options);
     
     // Crear la base de datos si es que no existe
     $pdo_server->exec("CREATE DATABASE IF NOT EXISTS `$db_name`");
     
     // Conectar a la base de datos
     $dsn_db = "mysql:host=$host;dbname=$db_name;charset=$charset";
     $pdo = new PDO($dsn_db, $user, $pass, $options);
     
     // Crear las columnas de la base de datos si no existe
     $sql_create_table = "
        CREATE TABLE IF NOT EXISTS usuarios (
            id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            contrasena VARCHAR(255) NOT NULL,
            fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
     ";
     $pdo->exec($sql_create_table);
     
} catch (\PDOException $e) {

     // Si falla la conexion o la creacion
     die("Error al conectar o configurar la base de datos: " . $e->getMessage());
}

?>