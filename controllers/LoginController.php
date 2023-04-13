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
                    // Verificar el password

                    $autenticado = $auth->comprobarPassword($resultado);
                    if($autenticado){
                        // Autenticar al usuario
                        $auth->autenticar();
                        
                    } else {
                        // password incorrecto
                        $errores = Usuario::getErrores(); // consultar u obtener los errores
                    }
                }

            }
        }
        $router->render('auth/login', [
            'errores' => $errores

        ]);
    }
    public static function logout(){
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}