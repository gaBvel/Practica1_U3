<?php 

// Incluye la conexión a la base de datos
include 'db_connection.php';

$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';
$mensaje = '';
$producto_a_editar = null;

// 1. CREAR / ACTUALIZAR
if ($accion == 'crear' || $accion == 'actualizar') {
    $nombre = $_POST['nombre'] ?? '';
    $precio = $_POST['precio'] ?? 0.00;
    $cantidad = $_POST['cantidad'] ?? 0;
    
    // Validación mínima
    if (empty($nombre) || $precio <= 0 || $cantidad < 0) {
        $mensaje = "<p class='error'>Todos los campos son obligatorios y válidos.</p>";
    } else {
        try {
            if ($accion == 'crear') {
                $sql = "INSERT INTO productos (nombre, precio, cantidad) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$nombre, $precio, $cantidad]);
                $mensaje = "<p class='exito'>Producto creado exitosamente.</p>";

                header("Location: ../public/index.php"); 
                exit();

            } else if ($accion == 'actualizar') {
                $id = $_POST['id'] ?? null;
                if ($id) {
                    $sql = "UPDATE productos SET nombre = ?, precio = ?, cantidad = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$nombre, $precio, $cantidad, $id]);
                    $mensaje = "<p class='exito'>Producto ID $id actualizado exitosamente.</p>";

                    header("Location: ../public/index.php"); 
                    exit();
                }
            }
        } catch (PDOException $e) {
            $mensaje = "<p class='error'>Error de BD: " . $e->getMessage() . "</p>";
        }
    }
}

// 2. ELIMINAR
if ($accion == 'eliminar') {
    $id = $_GET['id'] ?? null;
    if ($id) {
        try {
            $sql = "DELETE FROM productos WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $mensaje = "<p class='exito'>Producto ID $id eliminado exitosamente.</p>";

            header("Location: ../public/index.php"); 
            exit();

        } catch (PDOException $e) {
            $mensaje = "<p class='error'>Error de BD: No se pudo eliminar el producto.</p>";
        }
    }
}


// 3. OBTENER DATOS PARA EDICIÓN
if ($accion == 'editar') {
    $id = $_GET['id'] ?? null;
    if ($id) {
        try {
            $sql = "SELECT id, nombre, precio, cantidad FROM productos WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $producto_a_editar = $stmt->fetch();
            if (!$producto_a_editar) {
                $mensaje = "<p class='error'>Producto no encontrado.</p>";
                $accion = ''; // Resetear acción para evitar mostrar formulario vacío
            }

        } catch (PDOException $e) {
            $mensaje = "<p class='error'>Error de BD al buscar producto.</p>";
        }
    }
}

// 4. LEER (Obtener todos los productos)
try {
    $sql = "SELECT id, nombre, precio, cantidad FROM productos ORDER BY id DESC";
    $productos = $pdo->query($sql)->fetchAll();

} catch (PDOException $e) {
    $productos = [];
    $mensaje .= "<p class='error'>No se pudo cargar la lista de productos: " . $e->getMessage() . "</p>";
}

?>