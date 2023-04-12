<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;

class LoginController {
    public static function login(Router $router){

        $errores = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $auth = new Usuario($_POST);
            $errores = $auth->validaciones();

            if(empty($errores)){
                // Verificar si el usuario existe
                $resultado = $auth->existeUsuario(); // Este método consulta sobre la instancia que acaba de ser creada

                if(!$resultado){
                    $errores = Usuario::getErrores();
                } else {
                    
                }

                // Verificar el password



                // Autenticar al usuario


            }

        }
        $router->render('auth/login', [
            'errores' => $errores

        ]);
    }
    public static function logout(){
        echo "desde el controlador2";
    }
}