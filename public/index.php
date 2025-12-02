<?php
session_start();

if (isset($_SESSION['user_nombre'])) {
    // 2. INCLUIR LA LÓGICA DEL CRUD si el usuario está logueado
    include '../php/process_products.php';
} else {
    header("Location: ../public/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>CRUD de Productos - Inventario</title>
    <link rel="stylesheet" href="../css/styles.css">

    <link rel="stylesheet" href="../css/styles2.css"> <!-- Nuevo CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <main>
        
        <div class="container-crud">

            <header>
                <h1>Gestión de Productos</h1>
                <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_nombre']); ?></p>
                <a class="btn-logout" href="../php/session_close.php">Cerrar Sesión</a>
            </header>


            <?php echo $mensaje ?>
            <!-- Creacion Actualizacion -->
            <div class="form-card">
                <h2><?php echo $producto_a_editar ? 'Editar Producto' : 'Añadir Nuevo Producto'; ?></h2>
                <form action="../php/process_products.php" method="POST" class="crud-form">

                    <!-- Campo oculto para manejar la acción y el ID si es actualización -->
                    <input type="hidden" name="accion" value="<?php echo $producto_a_editar ? 'actualizar' : 'crear'; ?>">
                    <?php if ($producto_a_editar): ?>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto_a_editar['id']); ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" required
                            value="<?php echo htmlspecialchars($producto_a_editar['nombre'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" id="precio" name="precio" step="0.01" min="0.01" required
                            value="<?php echo htmlspecialchars($producto_a_editar['precio'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" min="0" required
                            value="<?php echo htmlspecialchars($producto_a_editar['cantidad']); ?>">
                    </div>

                    <button type="submit" class="btn-submit">
                        <?php echo $producto_a_editar ? 'Guardar Cambios' : 'Crear Producto'; ?>
                    </button>

                    <?php if ($producto_a_editar): ?>
                        <a href="index.php" class="btn-eliminar">Cancelar Edición</a>
                    <?php endif; ?>

                </form>
            </div>


            <!-- Tabla de productos -->
            <h2 class="table-title">Inventario Actual</h2>

            <?php if (empty($productos)): ?>
                <p class="aviso">No hay productos en el inventario. ¡Crea el primero!</p>
            <?php else: ?>
                <div class="table-responsive">
                   
                    <table class="productos-table">
                        
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($productos as $producto): ?>
                                <tr>

                                    <td><?php echo htmlspecialchars($producto['id']); ?></td>
                                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                    <td>$<?php echo number_format(htmlspecialchars($producto['precio']), 2); ?></td>
                                    <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                                    <td class="acciones">
                                        <a class="btn-editar" href="index.php?accion=editar&id=<?php echo $producto['id']; ?>">Editar</a>
                                        <a class="btn-eliminar" href="../php/process_products.php?accion=eliminar&id=<?php echo $producto['id']; ?>"
                                            onclick="return confirm('¿Estás seguro de eliminar el producto: <?php echo htmlspecialchars($producto['nombre']); ?>?');">Eliminar</a>
                                    </td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>

                </div>
            <?php endif; ?>
        </div>
    </main>

</body>

</html>