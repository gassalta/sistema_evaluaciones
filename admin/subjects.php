<?php

session_start();
if ($_SESSION['admin'] == 'registered') {

	require_once('db.php');
	$langfile =  dirname(__DIR__) . "/lang/" . $language . ".php";
	require_once($langfile);

	require_once 'class/Materias.php';

	echo " 
	<html>
	<head>
		<title>Materias</title>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
		<link href=\"../css/estilo.css\" rel=\"stylesheet\" content=\"text/css\">
	</head>
	<body>";
	include('class/menu.php');

	if (isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
		$idmateria = $_REQUEST['id'];
		if (isset($_REQUEST['nombre']))
			$nombre = $_REQUEST['nombre'];
		if (isset($_REQUEST['unidades']))
			$unidades = $_REQUEST['unidades'];
	} else {
		$action = "consultar";
		$idmateria = '';
		$nombre = '';
		$unidades = '';
	}

	$materias = new modmaterias();

	if ($action == "consultar") {
		$materias->consultar("agregar", $idmateria, $nombre, $unidades);
	} else
	if ($action == "agregar") {
		print $materias->agregar($nombre, $unidades);
	} else if ($action == "editar") {
		print $materias->editar("guardar", $idmateria, $nombre, $unidades);
	} else if ($action == "guardar") {
		print $materias->guardar();
	} else if ($action == "borrar") {
		print $materias->borrar();
	}
} else {
	header('Location: login.php');
}
