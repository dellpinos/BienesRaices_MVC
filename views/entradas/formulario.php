<fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="entrada[titulo]" placeholder="Titulo" value="<?php echo s($entrada->titulo); ?>"> <!-- php para no tener q escribir dos veces en caso de error -->

            <label for="contenido">Texto:</label>
            <textarea id="contenido" name="entrada[contenido]" placeholder="Escriba aqui el texto"><?php echo s($entrada->contenido); ?></textarea>

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="entrada[imagen]">

            <input type="hidden" name="entrada[usuarios_id]" value="<?php echo $id; ?>">

            <?php if($entrada->imagen) :  ?>
                <img src="/imagenes/<?php echo $entrada->imagen; ?>" class="imagen-pequeña" >

            <?php endif; ?>

            
            
            <!-- Añadir usuario -->

</fieldset>
