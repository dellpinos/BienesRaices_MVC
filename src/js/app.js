document.addEventListener('DOMContentLoaded', function () {

    eventListeners();

    darkMode();

    /// confirmarAccion();


});


function darkMode() {

    // botonesDM(); //// <<<<<< Agregado

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    //console.log(prefiereDarkMode.matches);

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function () {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    })

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    })
}
function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));


}

function mostrarMetodosContacto(e){
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value === 'telefono'){
        contactoDiv.innerHTML = `
        <label for="telefono"></label>
                <input type="tel" placeholder="Ingresa tu Teléfono" id="telefono" name="contacto[telefono]">
                <p>Elija la fecha y la hora para ser contactado</p>

                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="contacto[fecha]">

                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="21:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
        <label for="email">E-mail</label>
        <input type="email" placeholder="Ingresa tu e-mail" id="email" name="contacto[email]" > 
        `;
    }

}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');
}

// function confirmarAccion(){  //  <<<< no funciona

//     const botonEliminar = document.querySelectorAll('.form-eliminar');

//     botonEliminar.forEach(boton => {
//         boton.addEventListener("click", function(e){
//             if(confirm("Estas seguro de eliminar este elemento?")){
//                 e.submit();   // <<<<< No funciona
//             } else {
//                 alert('Accion cancelada.');
//             }
//         });
//     });
    
// }

/** AGREGANDO COSAS */

// Botones en otro color en el Dark Mode

// function botonesDM(){

//     console.log('Desde Botones 00');
//     const botonesAmaCambiar = document.querySelectorAll('.boton-amarillo');
//     const botonesAmaCambiarB = document.querySelectorAll('.boton-amarillo-block');
//     const botonesRojCambiarB = document.querySelectorAll('.boton-rojo-block');
//     const botonesRojCambiar = document.querySelectorAll('.boton-rojo');


//     botonesAmaCambiar.forEach(e => {
//         console.log('Desde Botones 01');
//         e.classList.toggle('boton-gris');
//         e.classList.toggle('boton-amarillo');
//     });
//     botonesAmaCambiarB.forEach(e => {
//         console.log('Desde Botones 02');
//         e.classList.toggle('boton-gris-block');
//         e.classList.toggle('boton-amarillo-block');
//     });
//     botonesRojCambiar.forEach(e => {
//         console.log('Desde Botones 01');
//         e.classList.toggle('boton-negro');
//         e.classList.toggle('boton-rojo');
//     });
//     botonesRojCambiarB.forEach(e => {
//         console.log('Desde Botones 02');
//         e.classList.toggle('boton-negro-block');
//         e.classList.toggle('boton-rojo-block');
//     });

// }