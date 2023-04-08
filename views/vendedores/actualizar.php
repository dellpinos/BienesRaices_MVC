<main class="contenedor seccion">
    <h1>Actualizar Empleado</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error) : ?> <!-- busco errores en el array para mostrarlos -->
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST"> <!-- enctype="multipart/form-data" es para cargar imagenes -->
        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form> <!-- envio formulario al servidor -->
</main>