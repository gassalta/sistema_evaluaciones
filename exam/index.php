<?php

error_reporting(-1);
ini_set('display_errors', -1);
error_reporting(E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

require_once '../admin/config.inc.php';

require_once BASE_URL_ADMIN . '/db.php';
require_once BASE_URL_ADMIN . '/funciones.php';
require BASE_URL_EXAM.'/model/Examen.php';

$db = Database::getInstance();

// Archivo de idioma
$langfile = BASE_URL . "/lang/" . $language . ".php";
require_once($langfile);

if (!file_exists($langfile)) {
	rep_error(FILE_NOT_FOUND);
	exit;
}

require_once BASE_URL . '/vendor/autoload.php';

// Configuración de Twig
$loader = new \Twig\Loader\FilesystemLoader('templates'); // Carpeta donde están las plantillas
$twig = new \Twig\Environment($loader, [
	'cache' => false, // Desactiva caché en desarrollo
	'debug' => true,  // Activa el modo debug
]);

if (isset($_GET["evid"])){
	$clave = $_GET["evid"];
} else {
	$clave = '';
}


$form_exam = new Examen($db, $twig);
if (isset($_REQUEST["action"])) {
	if ($_REQUEST["action"] == "login") {
		echo $form_exam->login($clave);
		echo '<a href="'.URL_BASE.'">Volver al Inicio</a>';
	} else {
		if ($_REQUEST["action"] == "logout") {
			echo $form_exam->logout();
		}
	}
} else {
	echo $form_exam->login_form(traducir_cadena(FORM_DATA), $clave);
	echo '<a href="'.URL_BASE.'">Volver al Inicio</a>';
}
