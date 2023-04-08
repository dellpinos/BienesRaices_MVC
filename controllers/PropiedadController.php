<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;



class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $resultado = $_GET['resultado'] ?? null; // Muestra mensaje condicional
        $router->render("propiedades/admin", [
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }
    public static function crear(Router $router)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        // Array con mensajes de error para evitar el undefined
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD']  === 'POST') {

            /** Crea una nueva instancia  */
            $propiedad = new Propiedad($_POST['propiedad']); // almaceno el POST en memoria, utilizo la llave del array que utilizo para sincronizar

            /** SUBIDA DE ARCHIVOS */

            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Setear la imagen
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); // Realiza un resize a la imagen con intervention
                $propiedad->setImagen($nombreImagen);
            }

            // Validar datos
            $errores = $propiedad->validaciones();

            // Revisar que el array de errores este vacio
            if (empty($errores)) { // solo se ejecuta en caso de no haber errores

                //Crear la carpeta para las imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //Guarda en la base de datos
                $propiedad->guardar(); //almacena o no y devuelve un bool 

                // Mensaje de exito y error
                if ($resultado) {
                    // Redireccionar al usuario
                    header('location: /admin?resultado=1');
                }
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        // Validar datos
        $errores = $propiedad->validaciones();
        $vendedores = Vendedor::all();

        // Metodo POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args); // no creando una nueva instancia, estoy modificando la que esta en memoria

            // Validacion
            $errores = $propiedad->validaciones();

            //** Subida de archivos */

            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Resize y carga de imagen en la instancia actual
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); // Realiza un resize a la imagen con intervention
                $propiedad->setImagen($nombreImagen);
            }
            if (empty($errores)) {

                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                /**  Insertar en la base de datos */
                $resultado = $propiedad->guardar();
            }
        };

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }
    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar id
            $id = $_POST['eliminarId'];
            $id = filter_var($id, FILTER_VALIDATE_INT); // valida que no sea manipulado

            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
