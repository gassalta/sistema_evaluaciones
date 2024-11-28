<?php
session_start();
if ($_SESSION['admin'] == 'registered') {
	require_once 'config.inc.php';

	require_once BASE_URL_ADMIN . '/db.php';
	$db = Database::getInstance();
	// Archivo de idioma
	$langfile = BASE_URL . "/lang/" . $language . ".php";
	require_once($langfile);

	require_once BASE_URL_ADMIN . '/class/Students.php';

	echo " 
	<html>
	<head>
		<title>" . StudentsModule . "</title>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
		<link href=\"../css/estilo.css\" rel=\"stylesheet\" content=\"text/css\">
	</head>
	<body>";

	include BASE_URL_ADMIN . '/class/menu.php';

	if (isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
		if (isset($_REQUEST['id']))
			$idalumno = $_REQUEST['id'];
		else
			$idalumno = "";
		if (isset($_REQUEST['txtnombre']))
			$txtnombre = $_REQUEST['txtnombre'];
		else
			$txtnombre = "";
		if (isset($_REQUEST['txtnumctrl']))
			$txtnumctrl = $_REQUEST['txtnumctrl'];
		else
			$txtnumctrl = "";
	} else {
		$action = "consultar";
		$idalumno = "";
		$txtnombre = "";
		$txtnumctrl = "";
	}

	$alumnos = new Alumnos($db);

	if ($action == "consultar") {
		$alumnos->consultar("agregar", $idalumno, $txtnombre, $txtnumctrl);
	} else if ($action == "agregar") {
		print $alumnos->agregar($txtnombre, $txtnumctrl);
	} else if ($action == "editar") {
		print $alumnos->editar("guardar", $idalumno, $txtnombre, $txtnumctrl);
	} else if ($action == "guardar") {
		print $alumnos->guardar();
	} else if ($action == "borrar") {
		print $alumnos->borrar();
	}
} else {
	header('Location: login.php');
}
