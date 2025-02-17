<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado() {
    session_start();
    
//$auth = 
    if (!$_SESSION['login']) {
        header('Location: /');
    }
}
function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}
//muestre mensaje
function mostrarNotificacion($codigo) {
    switch ($codigo) {
        case 1:
            $mensaje = 'creado Correctamente';
            break;
        case 2:
            $mensaje = 'actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'eliminado Correctamente';
            break;       
        
        default:
            $mensaje = false;
            break;
    }
        return $mensaje;
}
function validarORedireccionar(string $url) {
    // validar la url por un id valido
     $id = $_GET['id'];
     $id = filter_var($id, FILTER_VALIDATE_INT);
     if (!$id) {
         header("Location: {$url} ");
    }
    return $id;
}