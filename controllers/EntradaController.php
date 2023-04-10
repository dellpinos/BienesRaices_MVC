<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\Entrada;
use Model\Usuario;
use Intervention\Image\ImageManagerStatic as Image;





class EntradaController
{
    public static function index(Router $router)
    {
        $usuarios = Usuario::all();
        $entradas = Entrada::all();
        // $resultado = $_GET['resultado'] ?? null; // Muestra mensaje condicional

        $router->render('entradas/adminEntradas', [
            'entradas' => $entradas,
            'usuarios' =>$usuarios
        ]); 
    }
    public static function crear(Router $router)
    {
        $entrada = new Entrada;
        $usuarios = Usuario::all();

        // Array con mensajes de error para evitar el undefined
        $errores = Entrada::getErrores();

        if ($_SERVER['REQUEST_METHOD']  === 'POST') {

            /** Crea una nueva instancia  */
            $entrada = new Entrada($_POST['entrada']); // almaceno el POST en memoria, utilizo la llave del array que utilizo para sincronizar

            /** SUBIDA DE ARCHIVOS */

            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Setear la imagen
            if ($_FILES['entrada']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800, 600); // Realiza un resize a la imagen con intervention
                $entrada->setImagen($nombreImagen);
            }

            // Validar datos
            $errores = $entrada->validaciones();

            // Revisar que el array de errores este vacio
            if (empty($errores)) { // solo se ejecuta en caso de no haber errores

                //Crear la carpeta para las imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //Guarda en la base de datos
                $entrada->guardar(); //almacena o no y devuelve un bool 

            }
        }

        $router->render('entradas/crear', [
            'entrada' => $entrada,
            'usuarios' => $usuarios,
            'errores' => $errores
        ]);
    }




    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/adminEntradas');
        $entrada = Entrada::find($id);
        // Validar datos
        $errores = $entrada->validaciones();
        $usuarios = Usuario::all();

        // Metodo POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['entrada'];

            $entrada->sincronizar($args); // no creando una nueva instancia, estoy modificando la que esta en memoria

            // Validacion
            $errores = $entrada->validaciones();

            //** Subida de archivos */

            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Resize y carga de imagen en la instancia actual
            if ($_FILES['entrada']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800, 600); // Realiza un resize a la imagen con intervention
                $entrada->setImagen($nombreImagen);
            }
            if (empty($errores)) {

                if ($_FILES['entrada']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                /**  Insertar en la base de datos */
                $entrada->guardar();
            }
        };

        $router->render('/entradas/actualizar', [
            'entrada' => $entrada,
            'errores' => $errores,
            'usuarios' => $usuarios
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
