<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {

        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
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
        $router->render('paginas/blog', []);
    }
    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada', []); 
    }
    public static function contacto(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

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
            $contenido = '<html> <p>Tienes un nuevo mensaje</p> </html>';

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
