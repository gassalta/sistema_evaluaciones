<?php

session_start();
if ($_SESSION['admin'] == 'registered') {
	require_once 'config.inc.php';

	require_once BASE_URL_ADMIN . '/db.php';
	$db = Database::getInstance();
	// Archivo de idioma
	$langfile = BASE_URL . "/lang/" . $language . ".php";
	require_once($langfile);
?>

	<html>

	<head>
		<title>Modulo de Reportes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			function popup(idtest, idalumno) {
				window.open("report_det.php?id=" + idtest + "&alumno=" + idalumno, "DisplayWindow", "toolbar=no,directories=no,menubar=no,progressbar=no,width=800,height=650");
			}
		</script>
	</head>

	<body>

		<?php
		include BASE_URL_ADMIN . '/class/menu.php';

		if (isset($_REQUEST['enviar']) && ($_REQUEST['idexamen'] <> '')) {
			if (isset($_REQUEST['opc']))
				$opc = $_REQUEST['opc'];
			else
				$opc = 1;

			switch ($opc) {
				case 1:
					$campo = 'talumnos.numcontrol ASC';
					break;
				case 2:
					$campo = 'tans1.aciertos DESC';
					break;
				default:
					$campo = 'talumnos.numcontrol ASC';
			}

			if (isset($_REQUEST['idexamen']))
				$nombre_examen = $_REQUEST['idexamen'];
			else
				$nombre_examen = '1';

			$query = "SELECT talumnos.idalumno, talumnos.numcontrol, talumnos.nombre, tans1.idtest, tans1.aciertos, (tans1.aciertos*100)/texamenes.totalpreg as calificacion 
					FROM talumnos LEFT JOIN tans1 ON talumnos.idalumno = tans1.idalumno
					LEFT JOIN texamenes ON tans1.idexamen = texamenes.idexamen
					WHERE texamenes.claveexamen = '" . $_REQUEST['idexamen'] . "' ORDER BY " . $campo;

			$req = $db->getPDO()->prepare($query);
			$req->execute();

			if ($req->rowCount() > 0) {
				echo "
		<br>Reporte de calificaciones para el examen <strong>" . $nombre_examen . "</strong>
		<hr/><br/>	
		<table align=\"center\">	
		<tr><td colspan=\"5\" align=\"right\"><a href=\"javascript:window.print();\">Imprimir</a></td></tr>
		<tr><td class=\"bgblue\">No. Control</td>
				<td class=\"bgblue\" width=\"50%\">Nombre</td>
				<td class=\"bgblue\">Aciertos</td>
				<td class=\"bgblue\">Calificaci&oacute;n</td>
				<td class=\"bgblue\">Detalles</td>			
		</tr>";
				while ($row = $req->fetch(PDO::FETCH_OBJ)) {
					echo "<tr>	<td align=\"center\">" . $row->numcontrol . "</td>
								<td >" . $row->nombre . "</td>						
								<td align=\"right\">" . $row->aciertos . "</td>
								<td align=\"right\">" . $row->calificacion . "</td>
								<td align=\"center\"><input type=\"button\" onclick=\"popup(" . $row->idtest . "," . $row->idalumno . ");\" value=\"Ver\"></td>										
						 </tr>";
				}
				$datetime = date("Y-m-d H:i");
				echo "</table> ";
				echo "<br/>Total: " . $req->rowCount();
				echo "<br/>
					<hr>Fecha: <em> " . $datetime . "</em>";
			} else {
				echo "
			<br>No se encontr&oacute; la clave del examen <strong>" . $nombre_examen . "</strong>
			<hr/><br/>";
			}
		} else {
		?>
			<form name="formrep" method="post" action="reports.php">

				<fieldset>
					<!-- <legend>Select a maintenance drone:</legend> -->
					<div><label for="clave">Clave del Examen</label>
						<input type="text" id="clave" name="idexamen">
					</div>
					<div><label for="">Ordenar por:</label>
						<div>
							<label><input type="radio" name="opc" value="2" checked>Calificacion</label>
							<label><input type="radio" name="opc" value="1">No. de control</label>
						</div>
					</div>
					<hr>
					<input type="submit" name="enviar" value="Generar">
				</fieldset>

				
			</form>
	<?php }
		echo "</body>
	</html>";
	} else {
		header('Location: login.php');
	}
	?>