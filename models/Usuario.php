<?php

namespace Model;

class Usuario extends ActiveRecord {

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password', 'username']; 
    

    public $id;
    public $email;
    public $password;
    public $username;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->username = $args['username'] ?? '';

    }
    public function validaciones()
    {
        if(!$this->email){
            self::$errores[] = 'Debes ingresar tu email';
        }
        if(!$this->password){
            self::$errores[] = 'El password es obligatorio';
        }
        return self::$errores;
    }
    public function existeUsuario(){
        // Revisar si un usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if(!$resultado->num_rows){
            self::$errores[] = 'El usuario no existe'; // <<<< no funciona
            return;
        }
        return $resultado;
    }
    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object();

        $autenticado = password_verify($this->password, $usuario->password);

        if(!$autenticado){
            self::$errores[] = 'El password es incorrecto';
        }
        $this->username = $usuario->username; // <<<<<<< Asigno el contenido de username (en la DB) al objeto en memoria

        $this->id = $usuario->id; // <<<<<<<<<< VER ESTO

        return $autenticado;
    }
    public function autenticar(){
        session_start();

        // Llenar el array de sesion
        $_SESSION['usuario_id'] = $this->id; // <<<<<
        $_SESSION['usuario'] = $this->email;
        $_SESSION['username'] = $this->username;
        $_SESSION['login'] = true;
        header('Location: /admin');

    }
}