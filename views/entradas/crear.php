<main class="contenedor seccion">
    <h1>Nueva entrada de Blog</h1>
    <?php foreach ($errores as $error) : ?> <!-- busco errores en el array para mostrarlos -->
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <a href="/entradas/admin" class="boton boton-verde">Volver</a>
    
    <form class="formulario" method="POST" enctype="multipart/form-data">
    
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Crear Entrada" class="boton boton-verde">
    </form>
</main>