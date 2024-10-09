<?php

session_start();
if  ($_SESSION['admin'] == 'registered'){

	require_once ('db.php');
	$langfile =  dirname(__DIR__)."/lang/" . $language . ".php";
	require_once($langfile);

?>

<html>
<head>
	<title>Modulo de Reportes</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
	function popup(idtest,idalumno) { 
		window.open("report_det.php?id="+idtest+"&alumno="+idalumno,"DisplayWindow","toolbar=no,directories=no,menubar=no,progressbar=no,width=800,height=650");
	}
	</script>
</head>
<body>

<?php
include ('class/menu.php');

if (isset($_REQUEST['enviar']) && ($_REQUEST['idexamen'] <> '')) {
	$selectbd = mysqli_connect($servidor,$usuario,$password,$basedatos);

	if(isset($_REQUEST['opc']))
		$opc = $_REQUEST['opc'];
	else
		$opc = 1;
	
	switch ($opc) {
		case 1 : 
			$campo='talumnos.numcontrol ASC';
			break;
		case 2 : 
			$campo='tans1.aciertos DESC';
			break;
		default:
			$campo='talumnos.numcontrol ASC';
		} 

	if(isset($_REQUEST['idexamen']))
		$nombre_examen = $_REQUEST['idexamen'];
	else
		$nombre_examen = '1';

	$query = "SELECT talumnos.idalumno, talumnos.numcontrol, talumnos.nombre, tans1.idtest, tans1.aciertos, (tans1.aciertos*100)/texamenes.totalpreg as calificacion 
					FROM talumnos LEFT JOIN tans1 ON talumnos.idalumno = tans1.idalumno
					LEFT JOIN texamenes ON tans1.idexamen = texamenes.idexamen
					WHERE texamenes.claveexamen = '" . $_REQUEST['idexamen'] . "' ORDER BY " . $campo;

	$req = mysqli_query($selectbd,$query) or (die(mysqli_error($selectbd,$query)));	

	if(mysqli_num_rows($req) > 0 )	{
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
		while ($row=mysqli_fetch_object($req)){
				echo "<tr>	<td align=\"center\">".$row->numcontrol."</td>
								<td >".$row->nombre."</td>						
								<td align=\"right\">".$row->aciertos."</td>
								<td align=\"right\">".$row->calificacion."</td>
								<td align=\"center\"><input type=\"button\" onclick=\"popup(".$row->idtest.",".$row->idalumno.");\" value=\"Ver\"></td>										
						 </tr>";	
		}
		$datetime=date("Y-m-d H:i");	
		echo "</table> ";
		echo "<br/>Total: " . mysqli_num_rows($req);				
		echo "<br/>
					<hr>Fecha: <em> ".$datetime."</em>";
		
		mysqli_free_result($req);								
	}
	else	{
		echo "
			<br>No se encontr&oacute; la clave del examen <strong>" . $nombre_examen . "</strong>
			<hr/><br/>";
	}
}
else {
	echo "
	<form name=\"formrep\" method=\"post\" action=\"reports.php\">
		<table>
			<tr><td class=\"bgwhite\">Clave de Examen:</td>
				  <td><input type=\"text\" name=\"idexamen\"> </td>
			</tr>		
		<tr><td class=\"bgwhite\">Ordenar por: </td>
			  <td>
					<input type=\"radio\" name=\"opc\" value=\"2\" checked=\"true\">Calificacion<br/>
					<input type=\"radio\" name=\"opc\" value=\"1\" >No. de control <br/>
					</td>
		</td>
		<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"enviar\" value=\"Generar\"></td></tr>
	</form><hr/>";
	} 	
echo"</body>
	</html>";
}
else{
	header('Location: login.php');
	}
?>