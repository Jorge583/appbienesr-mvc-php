<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
  public static function index(Router $router)
    { 
      $propiedades = Propiedad::all();
      $vendedores = Vendedor::all();
      // muestre mensaje condicional
      $resultado = $_GET['resultado'] ?? null;

      $router->render('propiedades/admin', [
        'propiedades' => $propiedades,
        'resultado'  => $resultado,
        'vendedores' => $vendedores
      ]); 
    }

    public static function crear(Router $router) 
    { 
      $propiedad = new Propiedad;
      $vendedores = Vendedor::all();
      // arereglo con mensajueas de errores
      $errores = Propiedad::getErrores();

      if($_SERVER['REQUEST_METHOD'] === 'POST') {
     
        //crear una neuva instancia   
    $propiedad = new Propiedad($_POST['propiedad']);
        //crear nombre unico
    $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg" ;
    //setear la imagen
    //reali9za un rosize a la imagen con intervention
    if ($_FILES['propiedad']['tmp_name'] ['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name'] ['imagen'])->fit(800,600);
        $propiedad->setImagen($nombreImagen); 
    }
    
    
    // validar 
    $errores = $propiedad->validar();

    if(empty($errores)) {
        
    //crear carpeta de subir imagenes
    if (!is_dir(CARPETA_IMAGENES)) {
         mkdir(CARPETA_IMAGENES);
       }           
    //guardar imagen en el servidor
    $image->save(CARPETA_IMAGENES . $nombreImagen);
     
    $propiedad->guardar(); 
        
      }
      
    }

      $router->render('propiedades/crear', [
        'propiedad' => $propiedad,
        'vendedores' => $vendedores,
        'errores'=> $errores
      ]);

    }

    public static function actualizar(Router $router ) 
    {
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);

        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();
       // metodo post para actualizar
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
     
        //asignar atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);
       
        //validacion 

        $errores = $propiedad->validar();
        //subida de archivos
        // generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

        if ($_FILES['propiedad']['tmp_name'] ['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name'] ['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen); 
        }
              
            //revisar que el array de errores este vacio
        if (empty($errores)) {
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
            //ALMACENAR LA IMAGEN
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            } 
            $propiedad->guardar();
            }
    }

        $router->render('/propiedades/actualizar', [
          'propiedad' => $propiedad,
          'errores' => $errores,
          'vendedores' => $vendedores
        ]);

    }

  
    public static function eliminar(){
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
            //VALIDAR ID
          $id = $_POST['id'];
          $id = filter_var($id, FILTER_VALIDATE_INT);
          if ($id) {
              $tipo = $_POST['tipo'];
              //compara lo que vamos a elminar
              if (validarTipoContenido($tipo)) {
                 // compara lo que vamoseliminar
                 $propiedad = Propiedad::find($id);
                 $propiedad->eliminar();   
              }   
          }
       }
         
      }
}


