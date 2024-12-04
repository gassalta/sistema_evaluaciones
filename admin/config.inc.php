<?php

global $servidor, $usuario, $password, $basedatos;

$servidor = "localhost";
$usuario = "root";
$password = "";
$basedatos = "seldb";

// Obtener la URL completa
$urlCompleta = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") .
    "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
// Remover el archivo o script actual para obtener la URL padre
$urlPadre = dirname($urlCompleta);
// Remover '/admin/' del final
$urlPadre = rtrim($urlPadre, '/admin/') . '/';
$urlPadre = rtrim($urlPadre, '/exam/') . '/';

/*lenguajes disponibles: english, spanish*/
define('URL_BASE', $urlPadre);
define('BASE_URL', dirname(__DIR__));
define('BASE_URL_ADMIN', dirname(__DIR__) . '/admin');
define('BASE_URL_EXAM', dirname(__DIR__) . '/exam');

$language = "spanish";
