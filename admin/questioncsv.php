<?php
session_start();
if ($_SESSION['admin'] == 'registered'){ 
	require_once ('config.inc.php');
	$langfile = "../lang/".$language.".php";
	require_once ($langfile);

?>

<html>
<head>
<?php	echo "<title>".AppTitle."-".AdminModule."</title>"; ?>
	<link rel="stylesheet" href="../css/estilo.css"/>   
</head>
<body>
<?php include ('menu.php');?>
<h2>Agregar preguntas por archivo CSV</h2>
<p>formato (CSV):<br/>
idmateria(integer), pregunta(cadena 255), opcion1(50), opcion2(50), opcion3(50), opcion4(50), respuesta(integer entre 1 y 4)
</p>
<table> 
	<form enctype="multipart/form-data" name="MyForm" action="upload.php" method="post"> 
	<tr><td>Elegir archivo</td>
		<td><input name="file" type="file" /></td></tr> 
	<tr><td colspan="2"><input type="submit" name="submit" size="20" value="Aceptar" /></td></tr> 
</table>  
</html> 
</body>
<?php
}
else {
	header('location: login.php');
	}
?>
