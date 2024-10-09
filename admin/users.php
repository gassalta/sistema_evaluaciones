<?php
session_start();
if ($_SESSION['admin'] == 'registered') {
	require_once ('db.php');
	$langfile =  dirname(__DIR__)."/lang/" . $language . ".php";
	require_once($langfile);
	
	echo " 
	<html>
	<head>
		<title>" . AppTitle . " - " . AdminModule . "</title>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
		<link href=\"../css/estilo.css\" rel=\"stylesheet\" content=\"text/css\">
		<script language=\"javascript\" src=\"js/md5.js\"></script> 			
	</head>
	<body>";
	include('class/menu.php');
	class modusuarios
	{
		private $bd;
		function __construct()
		{
			include('db.php');
			$this->bd = $mysqli;
		}

		function consultar($action = "agregar", $id = "", $nombre = "", $pass = "", $cargo = "")
		{
			$query = "SELECT * FROM tusuarios";
			$req = $this->bd->query($query);

			echo "<table border=1>
				<caption> Usuarios </caption>
				<tr>
					  <td class=\"bgblue\">Usuario </td>
					  <td class=\"bgblue\">Cargo</td>  
					  <td class=\"bgblue\" align=\"center\" colspan=\"2\">Acciones</td>    
				</tr>";
			while ($row = $req->fetch_object()) {
				echo "<tr>
							<td>" . $row->nombre . "</td>
							<td>" . $row->cargo . "</td>
					 		<td><input type=\"button\" onclick=\"location='users.php?action=editar&id=" . $row->idusuario . "&nombre=" . $row->nombre . "&password=" . $row->passwd . "&cargo=" . $row->cargo . "'\" value=\"editar\" /></td>
							 <td><input type=\"button\" onclick=\"if(confirm('�Desea eliminar el usuario seleccionado?')) location='users.php?action=borrar&id=" . $row->idusuario . "'\" value=\"eliminar\" /></td> 					 		
						 </tr>";
			}
			echo "</table><hr>						
						<form name=\"frmagregar\" method=\"post\" action=\"users.php?action=$action\">
						<input type=\"hidden\" name=\"id\" value=\"" . $id . "\">						
							<table border=0>								
								<tr><td>nombre: </td> <td><input type=\"text\" name=\"nombre\" value=\"" . $nombre . "\" size=\"40\"></td></tr>
								<tr><td>password:</td> <td><input type=\"password\" name=\"password\" value=\"" . $pass . "\" size=\"12\"></td></tr>
								<tr><td>cargo:</td> <td><input type=\"text\" name=\"cargo\" value=\"" . $cargo . "\" size=\"40\"></td></tr>
								<tr><td></td>
										<td align=\"center\"><input type=\"submit\" name=\"agregar\" value=\"" . $action . "\">
										<input type=\"button\" onclick=\"location='users.php';\" value=\"Cancelar\" /></td></tr>								
							</table><hr>
						</form>";
			echo "</body>";
		}

		function agregar()
		{
			$sql = "INSERT INTO tusuarios(nombre,passwd,cargo) VALUES('" . $_POST['nombre'] . "', md5('" . $_POST['password'] . "'),'" . $_POST['cargo'] . "')";
			if ($consulta = mysqli_query($this->bd, $sql)) {
				return $this->consultar();
			} else {
				echo "error al ejecutar el script SQL";
			}
		}

		function editar($action, $id, $nombre, $password, $cargo)
		{
			return $this->consultar($action, $id, $nombre, $password, $cargo);
		}

		function guardar()
		{
			$sql = "UPDATE tusuarios SET nombre='" . $_POST['nombre'] . "', passwd= md5('" . $_POST['password'] . "'), cargo='" . $_POST['cargo'] . "' 
						WHERE idusuario =" . $_POST['id'];
			if ($consulta = mysqli_query($this->bd, $sql)) {
				return $this->consultar("agregar", "", "", "");
			} else {
				echo "error al ejecutar el script SQL";
			}
		}

		function borrar()
		{
			$sql = "DELETE FROM tusuarios WHERE idusuario=" . $_REQUEST['id'];
			$consulta = mysqli_query($this->bd, $sql);
			return $this->consultar();
		}
	}

	if (isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
		$id = $_REQUEST['id'];
		if (isset($_REQUEST['nombre']))
			$nombre = $_REQUEST['nombre'];
		if (isset($_REQUEST['cargo']))
			$password = $_REQUEST['password'];
		if (isset($_REQUEST['cargo']))
			$cargo = $_REQUEST['cargo'];
	} else {
		$action = "consultar";
		$id = '';
		$nombre = '';
		$password	= '';
		$cargo = '';
	}

	$usuarios = new modusuarios();
	if ($action == "consultar") {
		$usuarios->consultar("agregar", $id, $nombre, $password, $cargo);
	} else
	if ($action == "agregar") {
		print $usuarios->agregar($nombre, $password, $cargo);
	} else if ($action == "editar") {
		print $usuarios->editar("guardar", $id, $nombre, $password, $cargo);
	} else if ($action == "guardar") {
		print $usuarios->guardar();
	} else if ($action == "borrar") {
		print $usuarios->borrar();
	}
} else {
	header('Location: login.php');
}
