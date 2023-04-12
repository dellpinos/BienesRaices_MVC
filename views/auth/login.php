
<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach ?>

    <form class="formulario" method="POST"> <!-- Si no incluyo un action envia los datos a este mismo archivo -->
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" placeholder="Ingresa tu e-mail" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" placeholder="Ingresa tu Password" id="Password" name="password" required>

        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>

</main>