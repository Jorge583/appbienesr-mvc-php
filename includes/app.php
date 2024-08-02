<?php
require 'funciones.php';
require 'config/datebase.php';
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
//conectarnos a la base de datos 
$db = conectarDB();

use Model\ActiveRecord;

ActiveRecord::setDB($db);

//$propiedad = new Propiedad;




