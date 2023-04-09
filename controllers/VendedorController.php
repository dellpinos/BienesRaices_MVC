<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;


class VendedorController
{
    public static function crear(Router $router)
    {
        $vendedor = new Vendedor();

        // Array con mensajes de error para evitar el undefined
        $errores = Vendedor::getErrores();

        // Ejecutar el código despues de que el usuario envie el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);
            // Validaciones
            $errores = $vendedor->validaciones();
            // No hay errores
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }
        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        // Obtener el registro del vendedor desde la DB
        $vendedor = Vendedor::find($id);

        // Array con mensajes de error para evitar el undefined
        $errores = Vendedor::getErrores();

        // Ejecutar el código despues de que el usuario envie el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los valores
            $args = $_POST['vendedor'];
            //Sincronizar objeto en memoria
            $vendedor->sincronizar($args);
            // Validacion
            $errores = $vendedor->validaciones();
            // Sanitizar - Guardar
            if (empty($errores)) {
                $vendedor->guardar();
                // Mensaje de exito y error
            }
        }
        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar id
            $id = $_POST['eliminarId'];
            $id = filter_var($id, FILTER_VALIDATE_INT); // valida que no sea manipulado

            if ($id) {
                $tipo = $_POST['tipo']; // valida que exista el "tipo" (propiedad o vendedor) a eliminar
                if (validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}
