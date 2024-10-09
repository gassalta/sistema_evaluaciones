<?php
/*
 * menu.php : modulo de administracion
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>
 * <c> 2004 SEL-0.1beta
 */

echo "
 <img style=\"float: right;\" src=\"imagenes/logo-top03.png\"> <h3>".AdminModule."</h3>
	<table align=\"center\" class=\"bazul\" cellspacing=\"1\" cellpadding=\"4\"> 	
		<tr>	<td ><a href=\"index.php\" target=\"_self\">".Home."</a></td>
				<td style=\"border-left:2px solid #D8D8D8;\"><a href=\"questionform.php\" target=\"_self\">".AddQuestionsForm."</a></td>
				<td style=\"border-left:2px solid #D8D8D8;\"><a href=\"questioncsv.php\" target=\"_self\">".AddQuestionsCSV."</a></td>
				<td style=\"border-left:2px solid #D8D8D8;\"><a href=\"createexam.php\" target=\"_self\">".MakeQP."</a></td>
				<td style=\"border-left:2px solid #D8D8D8;\"><a href=\"users.php\" target=\"_self\">".ManUsers."</a></td>
				<td style=\"border-left:2px solid #D8D8D8;\"><a href=\"students.php\" target=\"_self\">Alumnos</a></td>
				<td style=\"border-left:2px solid #D8D8D8;\"><a href=\"subjects.php\" target=\"_self\">Materias</a></td>
				<td style=\"border-left:2px solid #D8D8D8;\"><a href=\"reports.php\" target=\"_self\">Reportes</a></td>
				<td style=\"border-left:2px solid #D8D8D8;\"><a href=\"login.php?action=logout\">Salir</a></td></tr>
</table><hr>";
?>
