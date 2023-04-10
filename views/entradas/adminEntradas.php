<?php
foreach ($entradas as $entrada) :
    $username = '';
    foreach ($usuarios as $usuario) :
        if ($entrada->usuarios_id === $usuario->id) {
            $username = $usuario->username;
        }
        $fecha = date("d/m/Y", strtotime($entrada->fecha)); // darle formato a la fecha
?>

        <main class="contenedor seccion contenido-centrado">
            <h1>Administrar Entradas de Blog</h1>
            <a href="/admin" class="boton boton-verde">Volver</a>

            <article class="entrada-blog">
                <div class="imagen">
                    <img src="/imagenes/<?php $entrada->imagen; ?>" alt="Imagen de la Entrada" loading="lazy">
                </div>
                <div class="texto-entrada">

                    <h4><?php echo $entrada->titulo; ?></h4>
                    <p class="informacion-meta">Escrito el: <span><?php echo $fecha; ?></span> por: <span><?php echo $username; ?></span> </p>
                    <p><?php echo $entrada->contenido; ?></p>
                    <div class="contenedor seccion">
                        <a class="boton boton-amarillo" href="/entradas/actualizar?id=<?php echo $entrada->id; ?>">Actualizar</a>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">

                            <input type="hidden" name="eliminarId" value="<?php echo $entrada->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                    </div>

                </div>
            </article> <!--entrada de blog-->

        </main>

    <?php endforeach; ?>
<?php endforeach; ?>