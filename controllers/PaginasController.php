<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
use Model\Entrada;
use Model\Usuario;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $entradas = Entrada::get(2);
        $usuarios = Usuario::all();
        $inicio = true;
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio,
            'entradas' => $entradas,
            'usuarios' =>$usuarios
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []); //render tiene parametros default
    }
    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);
        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router)
    {   
        $usuarios = Usuario::all();
        $entradas = Entrada::all();
        $router->render('paginas/blog', [
            'entradas' => $entradas,
            'usuarios' =>$usuarios
        ]); 
    }
    public static function entrada(Router $router)
    {
        $id = validarORedireccionar('/blog');
        $usuarios = Usuario::all();
        $entrada = Entrada::find($id);
        $router->render('paginas/entrada', [
            'entrada' => $entrada,
            'usuarios' => $usuarios
        ]);
        
    }
    public static function contacto(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuestas = $_POST['contacto'];
            // Crear instancia de PHP Mailer
            $mail = new PHPMailer();

            // Configurar  SMTP - Protocolo de envio de emails
            $mail->isSMTP();
            $mail->Host =  'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'd085369ca3249d';
            $mail->Password = '29907ebc88b5c6';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar contenido del Email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'Bienes Raices');
            $mail->Subject = 'Tienes un nuevo mensaje';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';
            $contenido .= '<p>Email: ' . $respuestas['email'] . ' </p>';
            $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . ' </p>';
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . ' </p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['opciones'] . ' </p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['presupuesto'] . ' </p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . ' </p>';
            $contenido .= '<p>Fecha de y hora contacto: ' . $respuestas['fecha'] . ' a las ' . $respuestas['hora'] . ' </p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto plano sin html';

            // Enviar el email
            if($mail->send()){
                echo "Mensaje enviado correctamente";
            } else {
                echo "El mensaje no fue enviado";
            }

        }

        $router->render('paginas/contacto', [

        ]);
    }
}
