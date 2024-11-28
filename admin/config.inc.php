<?php

global $servidor, $usuario, $password, $basedatos;

$servidor= "localhost";
$usuario = "root";
$password = "";
$basedatos = "seldb";

/*lenguajes disponibles: english, spanish*/
define('BASE_URL', dirname(__DIR__));
define('BASE_URL_ADMIN', dirname(__DIR__).'/admin');

$language ="spanish";
?>
