<?php
/*
 * subjects.php : modulo de administracion 
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>
 * <c> 2004 SEL-0.1beta
 */ 
//21/04/2004: es necesario reutilizar el cuerpo de los scripts materias.php, usuarios.php y alumnos.php  
//23/04/2004: implementacion de clases 

session_start();
if  ($_SESSION['admin'] == 'registered'){
	
	require_once ('config.inc.php');
	$langfile = "../lang/".$language.".php";
	require_once ($langfile);
	
	echo " 
	<html>
	<head>
		<title>Materias</title>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
		<link href=\"../css/estilo.css\" rel=\"stylesheet\" content=\"text/css\">
	</head>
	<body>";
include ('menu.php');

class modmaterias {
	function consultar($action="agregar", $idmat="", $nombre="", $unidades="") {
		$query = "SELECT idmateria, nombre, unidades FROM tmaterias";
		$req = mysql_query($query);
		echo "<table border=1>
				<caption> Materias </caption>
				<tr><td class=\"bgblue\">Clave</td>					  
					  <td class=\"bgblue\">Materia</td>
					  <td class=\"bgblue\">Unidades</td>
					  <td class=\"bgblue\" align=\"center\" colspan=\"2\">Acciones</td>  
				</tr>";
		while ($row = mysql_fetch_object($req)){
			echo "<tr>	 <td>".$row->idmateria."</td>						
							 <td>".$row->nombre."</td>
							 <td>".$row->unidades."</td>
							 <td><input type=\"button\" onclick=\"location='subjects.php?action=editar&id=".$row->idmateria."&nombre=".$row->nombre."&unidades=".$row->unidades."'\" value=\"editar\" /></td>
							 <td><input type=\"button\" onclick=\"if(confirm('¿Desea eliminar la materia seleccionada?')) location='subjects.php?action=borrar&id=".$row->idmateria."'\" value=\"eliminar\" /></td> 
						</tr>";	
			}			
			echo "</table><hr>						
						<form name=\"frmagregar\" method=\"post\" action=\"subjects.php?action=$action\">
						<input type=\"hidden\" name=\"id\" value=\"".$idmat."\">						
							<table border=0>								
								<tr><td>materia: </td> <td><input type=\"text\" name=\"nombre\" value=\"".$nombre."\" size=\"40\"></td></tr>
								<tr><td>unidades:</td> <td><input type=\"text\" name=\"unidades\" value=\"".$unidades."\" size=\"10\"></td></tr>
								<tr><td align=\"center\" colspan=\"2\"><input type=\"submit\" name=\"agregar\" value=\"".$action."\"></td></tr>								
							</table><hr>
						</form>";
			echo"</body>";			
		}
		
		function agregar($nombre, $unidades) {			
			$sql = "INSERT INTO tmaterias(nombre, unidades) VALUES('".$nombre."','".$unidades."')";
			if ($consulta = mysql_query($sql)) {
					return $this->consultar();
				}
			else {
				echo "error al agregar la materia";
			}
		}
		
		function editar($action, $idmateria, $nombre, $unidades) {
			return $this->consultar($action, $idmateria, $nombre, $unidades);
		}
		
		function guardar(){
			$sql = "UPDATE tmaterias SET nombre= '".$_POST['nombre']."', unidades = ".$_POST['unidades']."' 
						WHERE idmateria = ".$_REQUEST['id'];			
			$consulta = mysql_query($sql);
			return $this->consultar();			
		}
		
		function borrar() {
			$sql = "DELETE FROM tmaterias WHERE idmateria = ".$_REQUEST['id'];
			$consulta = mysql_query($sql);			
			return $this->consultar();
		}		
	}
	
	$conn = mysql_connect($servidor,$usuario,$password);
	$base = mysql_select_db($basedatos,$conn);
	
	if(isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
		$idmateria = $_REQUEST['id'];
		if(isset($_REQUEST['nombre']))
			$nombre = $_REQUEST['nombre'];
		if(isset($_REQUEST['unidades']))			
			$unidades = $_REQUEST['unidades'];			
	}
	else {
		$action = "consultar";	
		$idmateria = '';
		$nombre = '';
		$unidades = '';			
	}
		
	$materias = new modmaterias();		
			
	if($action == "consultar") {
		 $materias->consultar("agregar", $idmateria, $nombre, $unidades);	
	}
	else
	if ($action == "agregar") {
			print $materias->agregar($nombre, $unidades);
		} 
		else if ($action == "editar") {
					print $materias->editar("guardar", $idmateria, $nombre, $unidades);
				}
				else if ($action == "guardar") {
							print $materias->guardar();
						}
						else if ($action == "borrar") {
							 	print $materias->borrar();
								}
	
}
else{
	header('Location: login.php');
	}
?>