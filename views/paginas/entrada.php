<?php
$username = '';
foreach ($usuarios as $usuario) :
    if ($entrada->usuarios_id === $usuario->id) {
        $username = $usuario->username;
    }
    $fecha = date("d/m/Y", strtotime($entrada->fecha)); // darle formato a la fecha
endforeach;

?>

<main class="contenedor seccion contenido-centrado">

    <h1><?php echo $entrada->titulo; ?></h1>

    <img src="/imagenes/<?php echo $entrada->imagen; ?>" alt="Imagen de la Entrada" loading="lazy">


    <p class="informacion-meta">Escrito el: <span><?php echo $fecha; ?></span>  Editado por: <span><?php echo $username; ?></span> </p>
    <div class="resumen-propiedad">

        <p>
            <?php echo $entrada->contenido; ?>
        </p>

    </div>
</main>