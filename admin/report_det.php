<?php
/*
 * report_det.php : detalle para de la evaluaci�n
 * Andres Velasco Gordillo <phantomimo@gmail.com> 
 * <c> 2010 SEL-0.2beta
 */

session_start();
if  ($_SESSION['admin'] == 'registered'){

	require_once ('config.inc.php');
	$langfile = "../lang/".$language.".php";
	require_once ($langfile);

?>

<html>
<head>
	<title>Modulo de Reportes</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php

if (isset($_REQUEST['id'])) {
	if(isset($_REQUEST['alumno']))
		$alumno = $_REQUEST['alumno'];
	else
		$alumno = 0;	
		
	$selectbd = mysqli_connect($servidor,$usuario,$password,$basedatos);
	
	// alumno
	$query = "SELECT nombre FROM talumnos WHERE idalumno = " . $alumno;	
	$req = mysqli_query($selectbd,$query) or die(mysqli_error(). $query);	
	$row = mysqli_fetch_object($req);
	$nombre_alumno = $row->nombre;
	mysqli_free_result($req);


	// total de preguntas
	$query = "SELECT e.totalpreg, e.claveexamen FROM texamenes e LEFT JOIN tans1 a ON e.idexamen = a.idexamen
					  WHERE a.idtest = " . $_REQUEST['id'];	
	$req = mysqli_query($selectbd,$query) or die(mysqli_error(). $query);	
	$row = mysqli_fetch_object($req);
	$totalpreg = $row->totalpreg;
	$clave_examen = $row->claveexamen;	
	mysqli_free_result($req);

	// arreglo de respuestas
	$query = "SELECT a.a0,a.a1,a.a2,a.a3,a.a4,a.a5,a.a6,a.a7,a.a8,a.a9,a.a10,a.a11,a.a12,a.a13,a.a14,a.a15,a.a16,a.a17,a.a18,a.a19
						FROM tans1 a WHERE a.idtest = " . $_REQUEST['id'];
	$req = mysqli_query($selectbd,$query) or die(mysqli_error(). $query);	
	if(mysqli_num_rows($req) > 0 )	{		
		$a = array();
		if($row = mysqli_fetch_row($req)) {
				for($i=0; $i<mysqli_num_fields($req); $i++)
						$a[$i] = $row[$i];					
		}	
	}
	mysqli_free_result($req);

	// arreglo de preguntas
	$query = "SELECT e.q0,e.q1,e.q2,e.q3,e.q4,e.q5,e.q6,e.q7,e.q8,e.q9,e.q10,e.q11,e.q12,e.q13,e.q14,e.q15,e.q16,e.q17,e.q18,e.q19	
						FROM texamenes e LEFT JOIN tans1 a ON e.idexamen = a.idexamen
					  WHERE a.idtest = " . $_REQUEST['id'];	
	$req = mysqli_query($selectbd,$query);						  
	if(mysqli_num_rows($req) > 0 )	{				
		$q = array();
		if($row = mysqli_fetch_row($req)) {
				for($i=0; $i<mysqli_num_fields($req); $i++)
						$q[$i] = $row[$i];					
		}	
	}
	mysqli_free_result($req);	
	
	
		echo "
		<br/><strong>Detalle de examen</strong> 
		<br/><strong>Alumno:</strong> $nombre_alumno
		<br/><strong>Examen:</strong> $clave_examen
		<hr/>	
		<table border=1 align=\"center\" style=\"font-size:12px;\">	
		<tr><td colspan=\"5\" align=\"right\"><a href=\"javascript:window.print();\">Imprimir</a></td></tr>
		<tr><td class=\"bgblue\">Pregunta</td>
				<td class=\"bgblue\">Tu respuesta</td>
				<td class=\"bgblue\">Respuesta correcta</td>
		</tr>";	
		
		for($i=0; $i<$totalpreg; $i++)
		{
			// descripciones de preguntas y respuestas
			$query = "SELECT pregunta, respuesta FROM tbancopreguntas WHERE idpregunta='$q[$i]'";
			$req = mysqli_query($selectbd,$query) or die(mysqli_error(). $query);	
			if($row = mysqli_fetch_object($req)) {
						$pregunta = $row->pregunta;		
						$respuesta = $row->respuesta;										
						$query = "SELECT opcion".$row->respuesta." AS correcta, opcion".$a[$i]." AS alumno FROM tbancopreguntas WHERE idpregunta='$q[$i]'";
						$req2 = mysqli_query($selectbd,$query) or die(mysqli_error(). $query);	
						if($row = mysqli_fetch_object($req2)) {
							$respuesta_correcta = $row->correcta;
							$respuesta_alumno = $row->alumno;							
							mysqli_free_result($req2);															
						}													
			}

			echo "<tr>
							<td align=\"left\">".$pregunta."</td>";
			if($respuesta == $a[$i])  
					echo "<td align=\"center\" style=\"background:#51DC14;\">".$respuesta_alumno."</td>";
			else
					echo "<td align=\"center\" style=\"background:#DC2F14;\">".$respuesta_alumno."</td>";			
			echo" <td align=\"center\">".$respuesta_correcta."</td>";				
			echo "</tr>";	
			mysqli_free_result($req);								
		}
		echo "</table>
					<br>";
	}
	else	{
		echo "
			<br>No se encuentr&oacute; la clave del examen <strong>" . $nombre_examen . "</strong>
			<hr/><br/>";
	}
	echo"</body>
			</html>";
}
else{
	header('Location: login.php');
}
?>