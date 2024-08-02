<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function crear(Router $router) 
    {
       $errores = Vendedor::getErrores();//para atraer el arreglo de vendedor
       $vendedor = new Vendedor;
       
       if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //debuguear($_POST);
        //crea una neva instancia de la Vendedor
        $vendedor = new Vendedor($_POST['vendedor']);
                //debuguear($vendedor);
                 //validar que no halla campo vacios
             $errores = $vendedor->validar(); 
             //debuguear($errores);        
         //no hay errores
            if (empty($errores)) {//empty fubncion que verifica que un arreglo este vacio
                 $vendedor->guardar();
            }
     }  

       $router->render('vendedores/crear', [
            'errores' => $errores, //llevamos los errores ala vuista 
            'vendedor' => $vendedor
       ]);
        
    }

    public static function actualizar(Router $router ) {

        $errores = Vendedor::getErrores();

        $id = validarORedireccionar('/admin');
        //OBNTENER LOS DATOA DEL VENDEDOR A ACTUALIZAR
        $vendedor = Vendedor::find($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //asigna los valores
            $args = $_POST['vendedor'];
           //sigcroniza objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);
            
           // vaklidacion
           $errores = $vendedor->validar();
          
        if(empty($errores)) {
                $vendedor->guardar();
           }
    
         }

        $router->render('vendedores/actualizar', [
            'errores'  => $errores,
            'vendedor' => $vendedor,
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
                   $vendedor = Vendedor::find($id);
                   $vendedor->eliminar();   
                }   
            }
         }
           
    }
}