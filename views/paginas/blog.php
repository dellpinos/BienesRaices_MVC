<h1>Nuestro Blog</h1>
<main class="contenedor ">
<?php
foreach ($entradas as $entrada) :
    $username = '';
    foreach ($usuarios as $usuario) :
        if ($entrada->usuarios_id === $usuario->id) {
            $username = $usuario->username;
        }
    endforeach;
        $fecha = date("d/m/Y", strtotime($entrada->fecha)); // darle formato a la fecha
?>

            <article class="entrada-blog">
                <div class="imagen">
                <img src="/imagenes/<?php echo $entrada->imagen; ?>" alt="Imagen de la Entrada" loading="lazy">
                </div>
                <div class="texto-entrada">
                    <a href="/entrada?id=<?php echo $entrada->id; ?>">
                        <h4><?php echo $entrada->titulo; ?></h4>
                        <p class="informacion-meta">Escrito el: <span><?php echo $fecha; ?></span>  Editado por: <span><?php echo $username; ?></span> </p>
                        <p><?php echo $entrada->contenido; ?></p>
                    </a>
                </div>
            </article> <!--entrada de blog-->

<?php endforeach; ?>

</main>