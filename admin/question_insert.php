<?php
/*
 * question_insert.php : modulo de examen 
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>

 * Basado en phpexam de Senthil Nayagam
 * http://sourceforge.net/projects/phpexam/
 
 * <c> 2004 SEL-0.2beta
 */

session_start();
if ($_SESSION['admin'] == 'registered') {

	require_once('config.inc.php');
	$langfile = "../lang/" . $language . ".php";
	require_once($langfile);

	include('menu.php');
	include('db.php');

	$query = "INSERT INTO tbancopreguntas (idmateria, unidad, pregunta,opcion1,opcion2,opcion3,opcion4,respuesta) ";
	$query .= "VALUES(" . $_REQUEST['idmateria'] . "," . $_REQUEST['unidad'] . ",'" . htmlentities($_REQUEST['pregunta']) . "','" . $_REQUEST['opcion1'] . "',";
	$query .= "'" . $_REQUEST['opcion2'] . "','" . $_REQUEST['opcion3'] . "','" . $_REQUEST['opcion4'] . "','" . $_REQUEST['respuesta'] . "')";
	if (mysqli_query($base_selection, $query)) {
		echo "1 pregunta agregada...";
		echo "<meta http-equiv=Refresh Content=\"1; url=questionform.php?idmateria=" . $_REQUEST['idmateria'] . "\">";
	} else {
		echo "error al insertar el registro...<br/>";
		echo $query.'<br>';
		echo mysqli_error($base_selection);
	}
}
