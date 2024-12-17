<?php

class Alumnos
{
	private $bd;
	public function __construct(Database $db)
	{
		$this->bd = $db;
	}

	public function consultar($action, $idalumno, $txtnombre, $txtnumctrl)
	{
		$query = "SELECT * FROM talumnos";
		$req = $this->bd->getPDO()->prepare($query);
		$req->execute();

		echo "<table border=1>
				<caption> Alumnos </caption>
					<tr><td class=\"bgblue\">Control </td>
					<td class=\"bgblue\">Nombre </td>
				  	<td class=\"bgblue\">Materias </td>
					<td class=\"bgblue\" align=\"center\" colspan=\"2\">Acciones</td>    				  	
					</tr>";

		$datos = $req->fetchAll(PDO::FETCH_OBJ);

		foreach ($datos as $row) {
			echo "<tr><td>" . $row->numcontrol . "</td>
			  			  	<td>" . $row->nombre . "</td>
							<td align=\"center\">--</td>
					 		<td><input type=\"button\" onclick=\"location='students.php?action=editar&id=" . $row->idalumno . "&txtnombre=" . $row->nombre . "&txtnumctrl=" . $row->numcontrol . "'\" value=\"Editar\"></td>
							<td><input type=\"button\" onclick=\"if(confirm('�Desea eliminar el alumno seleccionado?')) location='students.php?action=borrar&id=" . $row->idalumno . "'\" value=\"Eliminar\"></td> 							
			 		</tr>";
		}
		echo "</table><hr>						
					<form name=\"frmagregar\" method=\"post\" action=\"students.php?action=$action\">
					<input type=\"hidden\" name=\"txtidalumno\" value=\"" . $idalumno . "\">
						<table border=0>								
							<tr><td>nombre: </td> <td><input type=\"text\" name=\"txtnombre\" value=\"" . $txtnombre . "\" size=\"40\"></td></tr>
							<tr><td>numero de ctrl.: </td> <td><input type=\"text\" name=\"txtnumctrl\" value=\"" . $txtnumctrl . "\" size=\"40\"></td></tr>							
							<tr><td></td>
									<td><input type=\"submit\" name=\"agregar\" value=\"" . $action . "\">
											<input type=\"button\" onclick=\"location='students.php';\" value=\"Cancelar\" />
											</td>    
									</tr>								
						</table><hr>
					</form>";
		echo "</body>";
	}

	function agregar($txtnombre, $txtnumctrl)
	{
		$sql = "INSERT INTO talumnos(nombre, numcontrol) VALUES('{$txtnombre}','{$txtnumctrl}');";
		if ((trim($txtnombre) != '')	&& (trim($txtnumctrl) != '')) {
			if ($this->bd->getPDO()->prepare($sql)->execute()) {
				return $this->consultar("agregar", "", "", "");
			} else {
				echo "(agregar alumno) error al ejecutar el script SQL <br /> ";
			}
		} else {
			echo "(agregar alumno) datos incompletos <br /> ";
		}
	}

	function editar($action, $idalumno, $txtnombre, $txtnumcontrol)
	{
		return $this->consultar($action, $idalumno, $txtnombre, $txtnumcontrol);
	}

	function guardar()
	{
		$id = $_POST['txtidalumno'];
		$nombre = $_POST['txtnombre'];
		$numcontrol =  $_POST['txtnumctrl'];
		$sql = "UPDATE talumnos SET nombre = '{$nombre}', numcontrol = '{$numcontrol}' WHERE idalumno = '{$id}'; ";
		if ($this->bd->getPDO()->prepare($sql)->execute()) {
			return $this->consultar("agregar", "", "", "");
		} else {
			echo "(guardar alumno) error al ejecutar el script SQL: ";
		}
	}

	function borrar()
	{
		$id = $_POST['id'];
		$sql = "DELETE FROM talumnos WHERE idalumno = '{$id}';";
		$this->bd->getPDO()->prepare($sql)->execute();
		return $this->consultar("agregar", "", "", "");
	}
}
