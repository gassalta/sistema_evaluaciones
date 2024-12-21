<?php

class Materias
{
	private $bd;
	public function __construct(Database $db)
	{
		$this->bd = $db;
	}

	function consultar($action = "agregar", $idmat = "", $nombre = "", $unidades = "")
	{
		$query = "SELECT idmateria, nombre, unidades FROM tmaterias";
		$req =  $this->bd->getPDO()->prepare($query);
		$req->execute();
		echo "<table border=1>
				<caption> Materias </caption>
				<tr><td class=\"bgblue\">Clave</td>					  
					  <td class=\"bgblue\">Materia</td>
					  <td class=\"bgblue\">Unidades</td>
					  <td class=\"bgblue\" align=\"center\" colspan=\"2\">Acciones</td>  
				</tr>";
		$datos = $req->fetchAll(PDO::FETCH_OBJ);

		foreach ($datos as $row) {
			echo "<tr>	 <td>" . $row->idmateria . "</td>						
							 <td>" . $row->nombre . "</td>
							 <td>" . $row->unidades . "</td>
							 <td><input type=\"button\" onclick=\"location='subjects.php?action=editar&id=" . $row->idmateria . "&nombre=" . $row->nombre . "&unidades=" . $row->unidades . "'\" value=\"editar\" /></td>
							 <td><input type=\"button\" onclick=\"if(confirm('�Desea eliminar la materia seleccionada?')) location='subjects.php?action=borrar&id=" . $row->idmateria . "'\" value=\"eliminar\" /></td> 
						</tr>";
		}
		echo "</table><hr>						
						<form name=\"frmagregar\" method=\"post\" action=\"subjects.php?action=$action\">
						<input type=\"hidden\" name=\"id\" value=\"" . $idmat . "\">						
							<table border=0>								
								<tr><td>materia: </td> <td><input type=\"text\" name=\"nombre\" value=\"" . $nombre . "\" size=\"40\"></td></tr>
								<tr><td>unidades:</td> <td><input type=\"text\" name=\"unidades\" value=\"" . $unidades . "\" size=\"10\"></td></tr>
								<tr><td align=\"center\" colspan=\"2\"><input type=\"submit\" name=\"agregar\" value=\"" . $action . "\"></td></tr>								
							</table><hr>
						</form>";
		echo "</body>";
	}

	function agregar($nombre, $unidades)
	{
		$sql = "INSERT INTO tmaterias(nombre, unidades) VALUES('{$nombre}','{$unidades}');";
		if ($this->bd->getPDO()->prepare($sql)->execute()) {
			return $this->consultar();
		} else {
			echo "error al agregar la materia";
		}
	}

	function editar($action, $idmateria, $nombre, $unidades)
	{
		return $this->consultar($action, $idmateria, $nombre, $unidades);
	}

	function guardar()
	{
		$id = $_REQUEST['id'];
		$nombre =  $_POST['nombre'];
		$unidades = $_POST['unidades'];

		$sql = "UPDATE tmaterias SET nombre = '{$nombre}', unidades = '{$unidades}' WHERE idmateria = '{$id}'; ";
		$consulta =  $this->bd->getPDO()->prepare($sql)->execute();
		return $this->consultar();
	}

	function borrar()
	{
		$id = $_REQUEST['id'];
		$sql = "DELETE FROM tmaterias WHERE idmateria = '{$id}';";
		$consulta =  $this->bd->getPDO()->prepare($sql)->execute();
		return $this->consultar();
	}
}
