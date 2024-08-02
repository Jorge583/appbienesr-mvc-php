<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $inicio = true;
        
        $router->render('paginas/index', [
            'propiedades'=> $propiedades,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router){
       
        $router->render('paginas/nosotros', []);
    }
    public static function propiedades(Router $router){
      
           $propiedades = Propiedad::all();
            $router->render('paginas/propiedades', [
                'propiedades'=> $propiedades,
                
            ]);
    }
    public static function propiedad(Router $router){
        $id = validarORedireccionar('/propiedades');
        
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [

            'propiedad' => $propiedad

        ]);
    }
    public static function blog(Router $router){
       

        $router->render('paginas/blog');
    }
    public static function entrada(Router $router){
        
        $router->render('paginas/entrada');
    }
    public static function contacto(Router $router) {
        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];
            
            //crear una instancia de PHPMailer
            $mail = new PHPMailer();

            //configutarar SMTP
            $mail->isSMTP();

            $mail->Host = 'smtp.mailtrap.io';

            $mail->SMTPAuth = true;

            $mail->Port = 2525;

            $mail->Username = '65ea7dee23aab0';

            $mail->Password = '50ab46fe552e31';
            
            $mail->SMTPSecure = 'tls';
            //configurar el contenido del mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'tiene un Mensaje Nuevo';
            // habilitar HTML
            $mail->isHTML(true);
            
            //definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un Mensaje Nuevo</p>';
            $contenido .= '<p>Nombre:  ' . $respuestas['nombre']  . '</p>';
            // enviar de forma consicional algunos campos de email o terlefono
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligio ser contactada por telefono</p>';
                $contenido .= '<p>Telefono:  ' . $respuestas['telefono']  . ' </p>';
                $contenido .= '<p>Fecha de Contacto:  ' . $respuestas['fecha']  . ' </p>';
                $contenido .= '<p>Hora:  ' . $respuestas['hora']  . ' </p>';
            } else {
                $contenido .= '<p>Eligio ser contactada por email</p>';
                $contenido .= '<p>Email:  ' . $respuestas['email']  . ' </p>';
            }
            $contenido .= '<p>Mensaje:  ' . $respuestas['mensaje']  . ' </p>';
            $contenido .= '<p>Vende o Compra:  ' . $respuestas['tipo']  . ' </p>';
            $contenido .= '<p>precio o Presupuesto:  $' . $respuestas['precio']  . ' </p>';
            $contenido .= '<p>Prefiere ser Contactado Por:  ' . $respuestas['contacto']  . ' </p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto Alternartivo sin HTML';

            // enviarmaial
            if($mail->send()) {
                $mensaje = "Mensaje Enviado Correctamente";
            } else {
                $mensaje = "el Mensaje no se pudo enviar...";
            }
        }
        
    

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);

    }
}