<?php
/*
 * options.php : modulo de administracion
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>
 * <c> 2004 SEL-0.1beta
 */

 
include ('menu.php');	//incluye las configuraciones basicas idioma,etc
echo "
<html>
<head>
	<link rel=\"stylesheet\" href=\"../css/estilo.css\">  
</head>";

$file ='config2.inc';
$fp=fopen($file, "r"); 
while ($data = fgetcsv ($fp, 1000, ",")) { 
    $num = count ($data);    
    $servidor=$data[0];    
    $usuario=$data[1];
    $password=$data[2];
    $basedatos=$data[3];
    $idioma=$data[4];
    $institucion=$data[5];          
}    
fclose ($fp);        


echo "
<body >
<table caption=\"Opciones\">
	<tr><td class=\"bgblue\" colspan=\"2\" align=\"center\"><h4>Base de Datos</h4></td></tr>
	<tr><td class=\"bgwhite\">Servidor:</td><td><input type=\"text\" name=\"server\" value=\"".$servidor."\"</td>
	<tr><td class=\"bgwhite\">Usuario:</td><td><input type=\"text\" name=\"server\" value=\"".$usuario."\"</td>
	<tr><td class=\"bgwhite\">Password:</td><td><input type=\"text\" name=\"server\" value=\"".$password."\"</td>
	<tr><td colspan=\"2\"><hr></td></tr>
	<tr><td class=\"bgblue\" colspan=\"2\" align=\"center\"><h4>Generales</h4></td></tr>
	<tr><td class=\"bgwhite\">Idioma:</td><td><input type=\"text\" name=\"server\" value=\"".$idioma."\"</td>
	<tr><td class=\"bgwhite\">Institucion:</td><td><input type=\"text\" size=\"30\"name=\"server\" value=\"".$institucion."\"</td>
</table>
</body>
</html>";
?>
