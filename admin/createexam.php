<?php
session_start();
if ($_SESSION['admin'] == 'registered') {

	require_once 'config.inc.php';
	require_once BASE_URL_ADMIN . '/db.php';
	$db = Database::getInstance();

	// Archivo de idioma
	$langfile = BASE_URL . "/lang/" . $language . ".php";
	require_once($langfile);

	if (!file_exists($langfile)) {
		rep_error(FILE_NOT_FOUND);
		exit;
	}

	$query = "SELECT * FROM tmaterias";

	$req1 = $db->getPDO()->prepare($query);
	$req1->execute();
	$datos = $req1->fetchAll(PDO::FETCH_OBJ);

	echo  "<html> 
	<head><title>" . AppTitle . " - " . AdminModule . "</title>
		<link rel=\"stylesheet\" href=\"../css/estilo.css\">
	</head>";
	echo "<body>";
	include BASE_URL_ADMIN.'/class/menu.php';
	echo "	
				<h2>Evaluaciones</h2>				  
			  <br><br>	  
			  <form name=\"form1\" method=\"post\" action=\"createexam2.php\">
			  \n " . Subjects . ": <select name=\"idmateria\" onchange=\"submit();\">\n
			  <option value=\"\">" . SelSub . "</option>\n";

	foreach ($datos as $row) {
		$idmateria = $row->idmateria;
		$nombre = $row->nombre;
		echo "<option value=\"$idmateria\">$nombre</option>\n";
	}
	echo "</select>";
	echo "<input type=\"hidden\" name=\"idusuario\" value=\"" . $_SESSION['idusuario'] . "\">";
	echo "<input type=\"submit\" name=\"Enviar\" value=\"Aceptar\">";
	echo "</form>
		  </body>
		  </html> ";
} else {
	header("Location: login.php");
}
