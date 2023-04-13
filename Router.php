<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {


        session_start();
        $auth = $_SESSION['login'] ?? null; // null previene el undefined
        // Array de rutas protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar', '/entradas/admin', '/entradas/crear', '/entradas/actualizar', '/entradas/eliminar'];


        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null; // Función asociada a esta url
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null; // Función asociada a esta url   
        }

        // Proteger rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /login');
        }


        if ($fn) {
            // Hay una funcion asociada a la url
            call_user_func($fn, $this);
        } else {
            echo "#404 Pagina inexistente   :(";
        }
    }
    // Muestra vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start(); // Comienza a almacenar datos en el buffer del servidor

        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Asigna los datos almacenados y libera la memoria

        include_once __DIR__ . "/views/layout.php";
    }
}
