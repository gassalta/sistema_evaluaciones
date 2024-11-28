<?php
session_start();
if ($_SESSION['admin'] == 'registered') {
	require_once 'config.inc.php';

	require_once BASE_URL_ADMIN . '/db.php';
	$db = Database::getInstance();
	// Archivo de idioma
	$langfile = BASE_URL . "/lang/" . $language . ".php";
	require_once($langfile);

	if (!file_exists($langfile)) {
		rep_error(FILE_NOT_FOUND);
		exit;
	}

	require_once BASE_URL_ADMIN . '/class/Users.php';

	echo " 
	<html>
	<head>
		<title>" . AppTitle . " - " . AdminModule . "</title>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
		<link href=\"../css/estilo.css\" rel=\"stylesheet\" content=\"text/css\">
		<script language=\"javascript\" src=\"js/md5.js\"></script> 			
	</head>
	<body>";
	include BASE_URL_ADMIN . '/class/menu.php';

	if (isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
		$id = $_REQUEST['id'];
		/* if (isset($_REQUEST['nombre']))
			$nombre = $_REQUEST['nombre'];
		if (isset($_REQUEST['cargo']))
			$password = $_REQUEST['password'];
		if (isset($_REQUEST['cargo']))
			$cargo = $_REQUEST['cargo']; */
	} else {
		$action = "consultar";
		$id = '';
		$nombre = '';
		$password	= '';
		$cargo = '';
	}

	$usuarios = new Users($db);
	if ($action == "consultar") {
		$usuarios->consultar("agregar", $id, $nombre, $password, $cargo);
	} else if ($action == "agregar") {
		echo $usuarios->agregar($nombre, $password, $cargo);
	} else if ($action == "editar") {
		echo $usuarios->editar("guardar", $id, $nombre, $password, $cargo);
	} else if ($action == "guardar") {
		echo $usuarios->guardar();
	} else if ($action == "borrar") {
		echo $usuarios->borrar();
	}
} else {
	header('Location: login.php');
}
