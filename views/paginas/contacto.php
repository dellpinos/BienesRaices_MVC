<main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="Imagen Contacto" loading="lazy">
        </picture>

        <h2>Llene el formulario de Contacto</h2>

        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Ingresa tu nombre" id="nombre" name="contacto[nombre]" >

                <label for="email">E-mail</label>
                <input type="email" placeholder="Ingresa tu e-mail" id="email" name="contacto[email]" > 

                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Ingresa tu Teléfono" id="telefono" name="contacto[telefono]">

                <label for="nombre">Mensaje</label>
                <textarea id="mensaje" placeholder="Escriba su mensaje" name="contacto[mensaje]" ></textarea>
            </fieldset>
            <fieldset>
                <legend>Información sobre la Propiedad</legend>

                <label for="opciones">Vende o Compra</label>
                <select id="opciones" name="contacto[opciones]" >
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" name="contacto[presupuesto]" >

            </fieldset>
            <fieldset>
                <legend>Información sobre la Propiedad</legend>

                <p>Como desea ser contactado</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label> <!-- Agregar required s  -->
                    <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" > 

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" >
                </div>
                <p>Si eligió teléfono, elija la fecha y la hora para ser contactado</p>

                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="contacto[fecha]">

                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="21:00" name="contacto[hora]">

            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>