<?php

namespace Model;

class Usuario extends ActiveRecord {

    protected static $columnasDB = ['id', 'email', 'username']; // este array me permite mapear y unir todos los atributos del POST en un array iterable
    //  'password',
    protected static $tabla = 'usuarios';

    public $id;
    public $email;
    // public $password;
    public $username;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        // $this->password = $args['password'] ?? '';
        $this->username = $args['username'] ?? '';

    }
    public function validaciones()
    {
        // // Validaciones
        // if (!$this->titulo) {
        //     self::$errores[] = "Debes añadir un titulo";
        // }
        // if (strlen($this->contenido) < 50 || strlen($this->contenido) > 600) { //evalua cantidad de caracteres
        //     self::$errores[] = "La descripcion debe contener entre 50 y 600 caracteres.";
        // }
        // if (!$this->fecha) {
        //     self::$errores[] = "Debes haber una fecha";
        // }
        // if (!$this->imagen) {
        //     self::$errores[] = "La imagen es obligatoria";
        // }
        // if (!$this->usuarios_id) {
        //     self::$errores[] = "Elige un usuario";
        // }

        return self::$errores;
    }
}