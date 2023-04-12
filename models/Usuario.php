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

        if(!$resultado){
            self::$errores[] = 'El usuario no existe';
            return;
        }
        return $resultado;

        debuguear($resultado);
    }
}