<?php

error_reporting(-1);
ini_set('display_errors', -1);
error_reporting(E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

require('model/model_exam.php');

$seleccionar_db = mysqli_connect($servidor, $usuario, $password, $basedatos) or die("error de conexion a la base de datos");

if (isset($_GET["evid"]))
	$clave = $_GET["evid"];
else
	$clave = '';

$form_exam = new  moduloexamen();
if (isset($_REQUEST["action"])) {
	if ($_REQUEST["action"] == "login") {
		echo $form_exam->login($clave);
	} else {
		if ($_REQUEST["action"] == "logout") {
			echo $form_exam->logout();
		}
	}
} else {
	echo $form_exam->login_form(traducir_cadena(FORM_DATA), $clave);
}
