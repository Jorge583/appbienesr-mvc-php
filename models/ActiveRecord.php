<?php

namespace Model;

class ActiveRecord {
        //Base De Datos
        protected static $db;
        protected static $columnasDB = [];
        protected static $tabla = '';
         
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
        public $nombre;
        public $apellido;
        public $telefono;
    
        //errores
        protected static $errores = [];
       
        //definimods la conexion a la BD
            public static function setDB($datebase) {
              self::$db = $datebase;
            }
        // static busca las propiedades en los hijos propiedad y venddor 
        //self busca las propiedades en la clase pádre activerecord

        public function guardar() {
          if(!is_null($this->id)) {
            //actuaklizar
            $this->actualizar();
          } else {
            //crnaso nuevo registro 
            $this->crear();
          }
        }
       public function crear() {
            // sanitizar los datos 
         $atributos = $this->sanitizarAtributos();
        //INSERTA LA BASE DATOS;
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
    
        $resultado = self::$db->query($query);
       
          // mensaje de exito
          if($resultado) {
            // redireccionar al usuario
            header('Location: /admin?resultado=1');
             }
      }
    
      public function actualizar() {
        $atributos = $this->sanitizarAtributos();
    
        $valores = [];
        foreach($atributos as $key => $value){
          $valores[] = "{$key}='{$value}'";
        }
        
        $query = " UPDATE " . static::$tabla . " SET ";
        $query .=  join(',', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .=" LIMIT 1 ";
       
        $resultado = self::$db->query($query);
        
        if($resultado) {
          // redireccionar al usuario
          header('Location: /admin?resultado=2');
           }
      }
      //eliminar registro
      public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id =" . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
    
        if ($resultado) {
          $this->borrarImagen();
          header('location: /admin?resultado=3');
        }  
      }
        //identificar y unir los atyributos de la bd
        public function atributos() {
          $atributos = [];
          foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
          }
          return $atributos;
        }
        // debuguear($query);
          public function sanitizarAtributos() {
            $atributos = $this->atributos();
            $sanitizado = [];
            //debuguear($atributos);
    
            foreach($atributos as $key => $value) {
              $sanitizado[$key] = self::$db->escape_string($value);
            }
            return $sanitizado;
          }
      //subidas de archivos
    public function setImagen($imagen){
      //eliminar la imagen en su campo
      if ( !is_null($this->id) ) {
          $this->borrarImagen();
        }
        //asignar al atributo de imagen el nombre de la imagen
      if ($imagen) {
        $this->imagen = $imagen;
      }
      }
    //eliomina archivo
    public function borrarImagen() {
      $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
           unlink(CARPETA_IMAGENES . $this->imagen);
           }
         }
    //validacion
        public static function getErrores() {
        return static::$errores;
        }
        //validacion
        public function validar() {
          static::$errores = [];
          return static::$errores;
        }
          //lista todas las propiedades
          public static function all() {
            $query ="SELECT * FROM " . static::$tabla;
        
            $resultado = self::consultarSQL($query);
    
            return($resultado);
          }
          //lista todos los registro
          public static function get($cantidad) {
            $query ="SELECT * FROM " . static::$tabla . " LIMIT " .  $cantidad;
            
            $resultado = self::consultarSQL($query);
    
            return $resultado;
          }
    
             //buscar listado por su id
          public static function find($id){
            $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
    
            $resultado = self::consultarSQL($query);
    
            return(array_shift($resultado));
          }
         
          public static function consultarSQL($query) {
            //consuktar a la base de dato
            $resultado = self::$db->query($query);
            //iterar sobre los resultados
            $array = [];
            while($registro = $resultado->fetch_assoc()) {
              $array[] = static::crearObjeto($registro);
            }
            //liberar la memoria
            $resultado->free();
            //retornar los resultados
            return $array;
         }
    
            // retornar los resultados
            protected static function crearObjeto($registro) {
              $objeto = new static;
              
              foreach($registro as $key => $value){
                if (property_exists($objeto, $key )) {
                  $objeto->$key = $value;
                }
              }
              return $objeto;
              }
              // csincroniza el objeto en memoria con los cambios ralizasos por el usuario
              public function sincronizar($args = [] ) {
                foreach($args as $key => $value){
                  if (property_exists($this, $key) && !is_null($value)) {
                    $this->$key = $value;
                  }
                }
    
              }
    }
  
     
