<?php
session_start();
if ($_SESSION['admin'] == 'registered') {

	require('db.php');
	$langfile = '../lang/' . $language . '.php';
	include($langfile);

	$query = "SELECT * FROM tmaterias";

	$req1 = mysqli_query($base_selection, $query);

	echo  "<html> 
	<head><title>" . AppTitle . " - " . AdminModule . "</title>
		<link rel=\"stylesheet\" href=\"../css/estilo.css\">
	</head>";
	echo "<body>";
	include("class/menu.php");
	echo "	
				<h2>Evaluaciones</h2>				  
			  <br><br>	  
			  <form name=\"form1\" method=\"post\" action=\"createexam2.php\">
			  \n " . Subjects . ": <select name=\"idmateria\" onchange=\"submit();\">\n
			  <option value=\"\">" . SelSub . "</option>\n";

	while ($row = mysqli_fetch_object($req1)) {
		$idmateria = $row->idmateria;
		$nombre = $row->nombre;
		echo "<option value=\"$idmateria\">$nombre</option>\n";
	}
	mysqli_free_result($req1);
	echo "</select>";
	echo "<input type=\"hidden\" name=\"idusuario\" value=\"" . $_SESSION['idusuario'] . "\">";
	echo "<input type=\"submit\" name=\"Enviar\" value=\"Aceptar\">";
	echo "</form>
		  </body>
		  </html> ";
} else {
	header("Location: login.php");
}
