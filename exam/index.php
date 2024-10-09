<?php
/*
 * index.php : modulo de examen 
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>

 * Basado en phpexam de Senthil Nayagam
 * http://sourceforge.net/projects/phpexam/
 
 * <c> 2004 SEL-0.2beta
 */

require('model/model_exam.php');

$seleccionar_db = mysqli_connect($servidor, $usuario, $password, $basedatos) or die("error de conexion a la base de datos");

if (isset($_GET["evid"]))
	$clave = $_GET["evid"];
else
	$clave = '';

$form_exam = new  moduloexamen();
if (isset($_REQUEST["action"])) {
	if ($_REQUEST["action"] == "login") {
		print $form_exam->login($clave);
	} else {
		if ($_REQUEST["action"] == "logout") {
			print $form_exam->logout();
		}
	}
} else {
	print $form_exam->login_form(traducir_cadena(FORM_DATA), $clave);
}
