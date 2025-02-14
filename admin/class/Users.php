<?php

class Users
{
    private $bd;
    public function __construct(Database $db)
    {
        $this->bd = $db;
    }

    function consultar($action = "agregar", $id = "")
    {
        $query = "SELECT * FROM tusuarios";
        $req = $this->bd->getPDO()->prepare($query);
        $req->execute();

        echo "<table border=1>
				<caption> Usuarios </caption>
				<tr>
					  <td class=\"bgblue\">Usuario </td>
					  <td class=\"bgblue\">Cargo</td>  
					  <td class=\"bgblue\" align=\"center\" colspan=\"2\">Acciones</td>    
				</tr>";
        while ($row = $req->fetch(PDO::FETCH_OBJ)) {
            echo "<tr>
							<td>" . $row->nombre . "</td>
							<td>" . $row->cargo . "</td>
					 		<td><input type=\"button\" onclick=\"location='users.php?action=editar&id={$row->idusuario}'\" value=\"editar\" /></td>
							 <td><input type=\"button\" onclick=\"if(confirm('¿Desea eliminar el usuario seleccionado?')) location='users.php?action=borrar&id=" . $row->idusuario . "'\" value=\"eliminar\" /></td> 					 		
						 </tr>";
        }
        echo "</table><hr>";

        if (!empty($id)) {
            $query = "SELECT * FROM tusuarios WHERE idusuario = '{$id}';";
            $req = $this->bd->getPDO()->prepare($query);
            $req->execute();

            if ($req->rowCount() != 0) {
                while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                    // 2024-12-21: Se comenta el pass porque al hacer un update se encripta la clave y no se puede comparar con la clave encriptada
                    // <tr><td>password:</td> <td><input type=\"password\" name=\"password\" value=\"" . $row->passwd . "\" size=\"12\"></td></tr>
                    echo "
                            <form name=\"frmagregar\" method=\"post\" action=\"users.php?action=$action\">
                            <input type=\"hidden\" name=\"id\" value=\"" . $id . "\">						
                                <table border=0>								
                                    <tr><td>nombre: </td> <td><input type=\"text\" name=\"nombre\" value=\"" . $row->nombre . "\" size=\"40\"></td></tr>
                                    
                                    <tr><td>cargo:</td> <td><input type=\"text\" name=\"cargo\" value=\"" . $row->cargo . "\" size=\"40\"></td></tr>
                                    <tr><td></td>
                                            <td align=\"center\"><input type=\"submit\" name=\"agregar\" value=\"" . $action . "\">
                                            <input type=\"button\" onclick=\"location='users.php';\" value=\"Cancelar\" /></td></tr>								
                                </table><hr>
                            </form>";
                }
            } else {
                echo 'El usuario no existe';
            }
        } else {
            echo "
            <form name=\"frmagregar\" method=\"post\" action=\"users.php?action=$action\">
            <input type=\"hidden\" name=\"id\" value=\"" . $id . "\">						
                <table border=0>								
                    <tr><td>nombre: </td> <td><input type=\"text\" name=\"nombre\" value=\"\" size=\"40\"></td></tr>
                    <tr><td>password:</td> <td><input type=\"password\" name=\"password\" value=\"\" size=\"12\"></td></tr>
                    <tr><td>cargo:</td> <td><input type=\"text\" name=\"cargo\" value=\"\" size=\"40\"></td></tr>
                    <tr><td></td>
                            <td align=\"center\"><input type=\"submit\" name=\"agregar\" value=\"" . $action . "\">
                            <input type=\"button\" onclick=\"location='users.php';\" value=\"Cancelar\" /></td></tr>								
                </table><hr>
            </form>";
        }

        echo "</body>";
    }

    function agregar()
    {
        $nombre = $_POST['nombre'];
        $pass = $_POST['password'];
        $cargo = $_POST['cargo'];

        $sql = "INSERT INTO tusuarios(nombre,passwd,cargo) VALUES('{$nombre}', md5('{$pass}'),'{$cargo}')";
        if ($this->bd->getPDO()->prepare($sql)->execute()) {
            return $this->consultar();
        } else {
            echo "error al ejecutar el script SQL";
        }
    }

    function editar($action, $id)
    {
        return $this->consultar($action, $id);
    }

    function guardar()
    {
        $id =  $_POST['id'];
        $nombre = $_POST['nombre'];
        // $clave = md5($_POST['password']); -- passwd = '{$clave}',
        $cargo = $_POST['cargo'];

        $sql = "UPDATE tusuarios
                 SET nombre='{$nombre}',
                    cargo='{$cargo}' 
						WHERE idusuario = '{$id}'; ";
        if ($this->bd->getPDO()->prepare($sql)->execute()) {
            return $this->consultar("agregar", "", "", "");
        } else {
            echo "error al ejecutar el script SQL";
        }
    }

    function borrar()
    {
        $sql = "DELETE FROM tusuarios WHERE idusuario=" . $_REQUEST['id'];
        $this->bd->getPDO()->prepare($sql)->execute();
        return $this->consultar();
    }
}
