

<main class="contenedor seccion">
    <h1>Menú Administrador</h1>

    <?php
        if($resultado) :
            $mensaje = mostrarNotificacion(intval($resultado)); // convierto string a int
            if ($mensaje) : ?>
                <p class="alerta exito"> <?php echo s($mensaje); ?> </p>
            <?php endif; ?>
        <?php endif; ?>
    

    <a href="/propiedades/crear" class="boton boton-verde">Nueva propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo vendedor</a>
    <a href="/entradas/admin" class="boton boton-verde">Administrar Entradas de Blog</a>

    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr> <!-- cabecera de la lista/ columnas de la DB -->
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <!-- Mostrar resultados de la DB -->

        <tbody>
            <?php foreach ($propiedades as $propiedad) :  ?>
                <tr>

                    <th><?php echo $propiedad->id; ?></th> <!-- Proceso e imprimo -->
                    <th><?php echo $propiedad->titulo; ?></th>
                    <th> <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"> </th>
                    <th>$ <?php echo $propiedad->precio; ?></th>
                    <th>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">

                            <input type="hidden" name="eliminarId" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <table class="propiedades">
        <thead>
            <tr> <!-- cabecera de la lista/ columnas de la DB -->
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <!-- Mostrar resultados de la DB -->

        <tbody>
            <?php foreach ($vendedores as $vendedor) :  ?>
                <tr>

                    <th><?php echo $vendedor->id; ?></th> <!-- Proceso e imprimo -->
                    <th><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></th>
                    <th><?php echo $vendedor->telefono; ?></th>
                    <th><?php echo $vendedor->email; ?></th>
                    <th>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">

                            <input type="hidden" name="eliminarId" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>