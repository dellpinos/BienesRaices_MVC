<main class="contenedor seccion ">
    <h1>Administrar Entradas de Blog</h1>
    <div class="contenedor-botones">
        <a href="/admin" class="boton boton-verde">Volver</a>
        <a href="/entradas/crear" class="boton boton-verde">Crear</a>
    </div>

    <?php
    foreach ($entradas as $entrada) :
        $username = '';
        foreach ($usuarios as $usuario) :
            if ($entrada->usuarios_id === $usuario->id) {
                $username = $usuario->username;
            }
            $fecha = date("d/m/Y", strtotime($entrada->fecha)); // darle formato a la fecha
    ?>
        
            <article class="entrada-blog admin-article">
                <div class="imagen">
                    <img src="/imagenes/<?php echo $entrada->imagen; ?>" alt="Imagen de la Entrada" loading="lazy">
                </div>
                <div class="texto-entrada">
                <a href="/entrada?id=<?php echo $entrada->id; ?>">

                    <h4><?php echo $entrada->titulo; ?></h4>
                    <p class="informacion-meta">Escrito el: <span><?php echo $fecha; ?></span> por: <span><?php echo $username; ?></span> </p>
                    <p><?php echo $entrada->contenido; ?></p>
                </a>

                </div>
                
            </article> <!--entrada de blog-->
            <div class="contenedor-botones">
                    <a class="boton boton-amarillo" href="/entradas/actualizar?id=<?php echo $entrada->id; ?>">Actualizar</a>
                    <form class="form-eliminar" method="POST" class="w-100" action="/entradas/eliminar">

                        <input type="hidden" name="eliminarId" value="<?php echo $entrada->id; ?>">
                        <input type="submit" class="boton-rojo-block" value="Eliminar"> <!-- Sacar este submit -->
                    </form>
                </div>



        <?php endforeach; ?>
    <?php endforeach; ?>
</main>