<h1>Nuestro Blog</h1>

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

            <article class="entrada-blog">
                <div class="imagen">
                    <img src="/imagenesBlog/<?php $entrada->imagen; ?>" alt="Imagen de la Entrada" loading="lazy">
                </div>
                <div class="texto-entrada">
                    <a href="/entrada?id=<?php echo $entrada->id; ?>">
                        <h4><?php echo $entrada->titulo; ?></h4>
                        <p class="informacion-meta">Escrito el: <span><?php echo $fecha; ?></span> por: <span><?php echo $username; ?></span> </p>
                        <p><?php echo $entrada->contenido; ?></p>
                    </a>

                </div>
            </article> <!--entrada de blog-->

        </main>

        <?php endforeach; ?>
<?php endforeach; ?>