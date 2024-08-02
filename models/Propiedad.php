<?php
//todo lo que este como public vamos hacer referencia a el como $this
//todo lo que esta como static vamos hacer referenbcia a el como self:: y en los atributo static llevan $
namespace Model;

class Propiedad extends ActiveRecord {
  
  protected static $tabla = 'propiedades';
  protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc',
        'estacionamiento', 'creado', 'vendedores_id'];
        
  public $id;
  public $titulo;
  public $precio;
  public $imagen;
  public $descripcion; 
  public $habitaciones;
  public $wc;
  public $estacionamiento;
  public $creado;
  public $vendedores_id; 

  public function __construct($args = []) 
  {
    $this->id = $args['id'] ?? null;
    $this->titulo = $args['titulo'] ?? '';
    $this->precio = $args['precio'] ?? '';
    $this->imagen = $args['imagen'] ?? '';
    $this->descripcion = $args['descripcion'] ?? '';
    $this->habitaciones = $args['habitaciones'] ?? '';
    $this->wc = $args['wc'] ?? '';
    $this->estacionamiento = $args['estacionamiento'] ?? '';
    $this->creado = date ('Y/m/d');
    $this->vendedores_id = $args['vendedores_id'] ?? '';
  }  
  public function validar() {
    
    if(!$this->titulo) {
        self::$errores[] = "debes añadir un titulo";
    }
    if(!$this->precio ) {
      self::$errores[] = "debes añadir un precio ";
     }
   if(strlen(!$this->descripcion) > 50) {
       self::$errores[] = "la descripcion es obligatoria y menor de 50 caracteres";
     }
     if(!$this->habitaciones) {
        self::$errores[] = "debes añadir un habitaciones";
     }
   if(!$this->wc) {
       self::$errores[] = "debes añadir un wc";
    }
    if(!$this->estacionamiento) {
       self::$errores[] = "debes añadir un estacionamiento";
    }
    if(!$this->vendedores_id) {
        self::$errores[] = "debes añadir un vendedores_id";
    }
    if(!$this->imagen ) {
        self::$errores[] = "La Imagen es Obligatoria por supuesto";
      }

      return self::$errores;
  }

}