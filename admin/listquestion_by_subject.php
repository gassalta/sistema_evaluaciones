<?php

require_once 'config.inc.php';
require_once BASE_URL_ADMIN . '/db.php';
$db = Database::getInstance();

require_once BASE_URL_ADMIN . '/funciones.php';

// Archivo de idioma
$langfile = BASE_URL . "/lang/" . $language . ".php";
require_once($langfile);

if (!file_exists($langfile)) {
	rep_error(FILE_NOT_FOUND);
	exit;
}

if (isset($_REQUEST['idmateria']))
	$idmateria = $_REQUEST['idmateria'];
else
	$idmateria = 1;


echo "
	<html>
	<head>
	<title>" . AppTitle . " - " . AdminModule . "</title>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
	<link rel=\"stylesheet\" href=\"../css/estilo.css\">
	</head>
	<body>	
	<h3>Preguntas disponibles</h3>
	<div style=\"text-align:right; padding-right:60px;\"><input type=\"button\"	onclick=\"top.frames.location='questionform.php?idmateria=$idmateria'\" value=\"Agregar pregunta\"/> </div>";

$query =  "SELECT * FROM tbancopreguntas WHERE idmateria='" . $idmateria . "' ORDER BY idpregunta ASC";
$req1 = $db->getPDO()->prepare($query);
$req1->execute();
$datos = $req1->fetchAll(PDO::FETCH_OBJ);

foreach ($datos as $row) {
	$questionid = $row->idpregunta;
	$subjectid = $row->idmateria;
	$question = $row->pregunta;
	$choice1 = $row->opcion1;
	$choice2 = $row->opcion2;
	$choice3 = $row->opcion3;
	$choice4 = $row->opcion4;
	$answer = $row->respuesta;
	$unit = $row->unidad;

	echo "<table width=\"90%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\n";
	echo "<tr><td class=\"bgwhite10\" align =\"center\" width=\"10%\"><b> " . $questionid . " </b></td>
			  <td class=\"bgwhite10\" colspan=4><span style=\"color:#2053A7;\">" . $question . "</span></td></tr>\n
		  <tr valign=\"top\"><td class=\"bgwhite10\" width=\"5%\">resp: " . $answer . "</td>
			  <td class=\"bgwhite10\" width=\"20%\"><span style=\"color:#2053A7;\">1)</span> " . $choice1 . "</td>
			  <td class=\"bgwhite10\" width=\"20%\"><span style=\"color:#2053A7;\">2)</span> " . $choice2 . "</td>
			  <td class=\"bgwhite10\" width=\"20%\"><span style=\"color:#2053A7;\">3)</span> " . $choice3 . "</td>
			  <td class=\"bgwhite10\" width=\"20%\"><span style=\"color:#2053A7;\">4)</span> " . $choice4 . "</td></tr>\n
			<tr><td class=\"bgwhite10\" width=\"5%\">unidad:" . $unit . "</td>
					<td colspan=\"4\" align=\"right\"><input type=\"button\" onclick=\"top.frames.location='questionform.php?id=$questionid&&idmateria=$subjectid&action=edit';\" value=\"Editar\">
						<input type=\"button\" onclick=\"if(confirm('�Desea eliminar la pregunta?')) location='question_delete.php?id=$questionid&idmateria=$subjectid&idunidad=$unit';\" value=\"Eliminar\">
			</td></tr>";
	echo "</table>\n";
	echo "<br>\n";
};
echo "</body>
	  </html>";
