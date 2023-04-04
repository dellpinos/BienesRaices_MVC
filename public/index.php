<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;

$router = new Router();

$router->get('/', 'funcion_nosotros');
$router->get('/anuncio', 'funcion_anuncio');
$router->get('/anuncios', 'funcion_anuncios');
$router->get('/contacto', 'funcion_contacto');

$router->comprobarRutas();