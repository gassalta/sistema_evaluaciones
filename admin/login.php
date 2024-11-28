<?php

error_reporting(-1);
ini_set('display_errors', -1);
error_reporting(E_ALL | E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

require_once 'config.inc.php';

require_once BASE_URL_ADMIN . '/db.php';
require_once BASE_URL_ADMIN . '/funciones.php';
require_once BASE_URL_ADMIN . '/class/Login.php';
require_once BASE_URL_ADMIN . '/class/Template.php';

$db = Database::getInstance();

require_once BASE_URL . '/vendor/autoload.php';

// Configuración de Twig
$loader = new \Twig\Loader\FilesystemLoader('templates'); // Carpeta donde están las plantillas
$twig = new \Twig\Environment($loader, [
	'cache' => false, // Desactiva caché en desarrollo
	'debug' => true,  // Activa el modo debug
]);

$LoginAdmin = new Login($db, $twig);
if (isset($_REQUEST["action"])) {
	if ($_REQUEST["action"] == "login") {
		echo $LoginAdmin->login();
	} else {
		if ($_REQUEST["action"] == "logout") {
			echo $LoginAdmin->logout();
		}
	}
} else {
	echo $LoginAdmin->login_form(traducir_cadena(LOGIN_DATA));
}
