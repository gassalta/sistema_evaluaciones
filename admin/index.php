<?php
error_reporting(-1);
ini_set('display_errors', -1);
error_reporting(E_ALL | E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

session_start();

require_once 'config.inc.php';

// Archivo de idioma
$langfile = BASE_URL . "/lang/" . $language . ".php";
require_once($langfile);

if (!file_exists($langfile)) {
	rep_error(FILE_NOT_FOUND);
	exit;
}

if (isset($_SESSION['admin']) == 'registered') {

	echo "
<!DOCTYPE html>
	<head>
	<title>" . AppTitle . " - " . AdminModule . "</title>
	<meta charset=\"utf-8\">
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
		<link rel=\"stylesheet\" href=\"../css/estilo.css\">  
	</head>
	<body>";
	include BASE_URL_ADMIN.'/class/menu.php';
	echo "			
		<h2>Bienvenido al m&oacute;dulo de administraci&oacute;n de SEL</h2>
		<h1>" . AddQuestions . "</h1>
		<h3>" . Method1 . "</h3>" . Method1Desc . "
		<h3>" . Method2 . "</h3>" . Method2Desc . "
		<h1>" . MakeQP . "</H1>" . MakeQPDesc . "	  
	</body>
	</html>";
} else {
	include_once BASE_URL_ADMIN.'/login.php';
}
