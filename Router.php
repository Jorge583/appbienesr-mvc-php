<?php 
namespace Controllers;
namespace MVC;


class Router {
        
  public array $rutasGET = [];
  public $rutasPOST = [];
  
    public function get($url, $fn) 
    {
        $this->rutasGET[$url] = $fn;
    }
    
    public function post($url, $fn) 
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {

        session_start();
        
        $auth = $_SESSION['login'] ?? null;
        // arreglo de rutas protegidas...
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/
        crear', '/vendedores/actualizar', '/vendedores/eliminar'];

         $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
         // metodo get para mostrar la paginas y metodo post cuando llenmos un formulario
         $metodo = $_SERVER['REQUEST_METHOD'];
              //echo "comprobandooo";
            if ($metodo === 'GET') {
              $fn = $this->rutasGET[$urlActual] ?? null;
            }else {
              //debuguear($this);
              $fn = $this->rutasPOST[$urlActual] ?? null;
            }  
            //Ptoteger las rutas
            if(in_array($urlActual, $rutas_protegidas) && !$auth) {
              header('Location: /');
            }
          
             //la URL existe Y hay una funcion asociasa
            if( $fn ) {
                  call_user_func($fn, $this);  

               } else {
                   echo "pagina no encontrado";
                  }
            
                }          
        
                  //mostrar una vista 
                  public function render($view, $datos = [] ) {
                      foreach($datos as $key => $value) {
                        $$key = $value;
                      }
                    //ob comienza guardar en memoria
                   ob_start();
                   include __DIR__ . "/views/$view.php";
                   //limpiar memoria para nuestro swrvidior no colapse
                   $contenido = ob_get_clean();
                  
                   include __DIR__ . '/views/layout.php';
                  }
                
  } 
  