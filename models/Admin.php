<?php
namespace Model;

class Admin extends ActiveRecord {
    //base datos
        protected static $tabla = 'usuarios';
        protected static $columnasDB = ['id', 'email', 'password'];

        public $id;
        public $email;
        public $password;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->email = $args['email'] ?? '';
            $this->password = $args['password'] ?? '';

        }

        public function validar() {
            if (!$this->email) {
                self::$errores[] = 'el email es obligatorio';
            }
            if (!$this->password) {
                self::$errores[] = 'el password es obligatorio';
            }
            return self::$errores;
        }
        public function existeUsuario(){
            $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

            $resultado = self::$db->query($query);

            if (!$resultado->num_rows) {
                self::$errores[] = 'EL USUARIO NO EXISTE';
                return;
            }
            return $resultado;
        }

        public function comprobarPassword($resultado) {
            $usuario = $resultado->fetch_object();

            $autenticado = password_verify($this->password, $usuario->password);

            if (!$autenticado) {
                self::$errores[] = 'El Password es Incorrecto';
            }
            return $autenticado;
        }

        public function autenticar() {
            session_start();

            //llenar el arreglo de session
            $_SESSION['usuario'] = $this->email;
            $_SESSION['login'] = true;

            header('Location: /admin');
            
        }
    }
