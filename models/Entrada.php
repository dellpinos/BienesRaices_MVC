<?php

namespace Model;

class Entrada extends ActiveRecord {

    protected static $columnasDB = ['id', 'titulo', 'contenido', 'fecha', 'imagen', 'usuarios_id']; // este array me permite mapear y unir todos los atributos del POST en un array iterable

    protected static $tabla = 'entradas';

    public $id;
    public $titulo;
    public $contenido;
    public $fecha;
    public $imagen;
    public $usuarios_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->fecha = $args['fecha'] ?? null;
        $this->imagen = $args['imagen'] ?? '';
        $this->usuarios_id = $args['usuarios_id'] ?? 2;   /// <<<< usuario id por default (modificar esto)
    }
    // Identificar y unir los atributos de la DB
    public  function atributos()
    { //itera
        $atributos = [];
        foreach (static::$columnasDB as $row) {
            if ($row === 'id') continue;
            if ($row === 'fecha') continue; /// <<<<<<<<<<< agregado
            $atributos[$row] = $this->$row;
        }
        return $atributos;
    }
    public function validaciones()
    {
        // Validaciones
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }
        if (strlen($this->contenido) < 50 || strlen($this->contenido) > 600) { //evalua cantidad de caracteres
            self::$errores[] = "El contenido debe contener entre 50 y 600 caracteres.";
        }
        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }
        if (!$this->usuarios_id) {
            self::$errores[] = "Elige un usuario";
        }

        return self::$errores;
    }
}