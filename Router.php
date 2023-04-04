<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];


    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }

    public function comprobarRutas(){
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null; // Función asociada a esta url
        }
        if($fn){
            // Hay una funcion asociada a la url
            call_user_func($fn, $this);
        } else {
            echo "#404 Pagina inexistente   :(";
        }
    }
}