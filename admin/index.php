<?php
/*
 * index.php : modulo de administracion
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>
 * <c> 2004 SEL-0.2
 */

session_start();
if ($_SESSION['admin'] == 'registered'){

require_once ('config.inc.php');
$langfile = "../lang/".$language.".php";
require_once ($langfile);
	echo "
	<html>
	<head>
	<title>".AppTitle." - ".AdminModule."</title>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
		<link rel=\"stylesheet\" href=\"../css/estilo.css\">  
	</head>
	<body>";
			include ('menu.php');
	echo "			
		<h2>Bienvenido al m&oacute;dulo de administraci&oacute;n de SEL</h2>
		<h1>".AddQuestions."</h1>
		<h3>".Method1."</h3>".Method1Desc."
		<h3>".Method2."</h3>".Method2Desc."
		<h1>".MakeQP."</H1>".MakeQPDesc."	  
	</body>
	</html>";
}
else{
	header('Location: login.php');
}
?>