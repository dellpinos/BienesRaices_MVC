<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>

    <?php include 'iconos.php'; ?>

</main>

<section class="seccion contenedor">
    <h2 class="m-top-bottom">Casas y Departamentos en Venta</h2>

    <!-- Include cards -->
    <?php

    include 'listado.php';
    ?>


    <div class="alinear-derecha">
        <a href="/propiedades" class="boton-verde">Ver Todas</a>
    </div>
</section>
<section class="imagen-contacto">
    <h2>Encuentra la Casa de tus Sueños</h2>
    <p>Llená el formulario de contacto y un asesor se pondrá en contacto con vos a la brevedad</p>
    <a href="/contacto" class="boton-amarillo">Contactanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>
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
                        <p class="informacion-meta">Escrito el: <span><?php echo $fecha; ?></span> Editado por: <span><?php echo $username; ?></span> </p>
                        <p><?php echo $entrada->contenido; ?></p>
                    </a>

                </div>
            </article> <!--entrada de blog-->
        <?php endforeach; ?>
    </section> <!-- un section porq contiene un h3 entre otros elementos-->

    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.</blockquote>
            <p>- Juan Ejemplo</p>
        </div>
    </section>
</div>