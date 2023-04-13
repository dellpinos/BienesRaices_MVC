<?php

//** Constantes */
define('TEMPLATES_URL', __DIR__ . '/templates'); // definiendo una url
define('FUNCIONES_URL', __DIR__ . 'funciones.php'); // misma carpeta
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/'); // consulto la ruta a la superglobal SERVER




define('CARPETA_IMAGENES_BLOG', $_SERVER['DOCUMENT_ROOT'] . '/imagenesBLog/'); // consulto la ruta a la superglobal SERVER <<<






//** Funciones */
function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/{$nombre}.php";
}

// Inicio sesion
function usuarioAutenticado(): void
{

    session_start();

    if (!$_SESSION['login']) {
        header('Location: /');
    }
}

// dev
function debuguear($parametro)
{
    echo "<pre>";
    var_dump($parametro);
    echo "</pre>";
    exit;
}

// Escapar / Sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}
// Validar tipo de contenido
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);  // busca un string o un valor dentro de un array, toma dos valores 1_lo que busca y 2_donde buscarlo
}

// Mostrar los mensajes
function mostrarNotificacion($codigo)
{
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = 'Creado correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarORedireccionar(string $url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    // Validacion del id dentro de la url
    if (!$id) {
        header("Location: {$url}");
    }
    return $id;
}
