<?php

session_start();
if (isset($_SESSION['admin']) == 'registered') {

	require_once('config.inc.php');
	$langfile = "../lang/" . $language . ".php";
	require_once($langfile);
	echo "
<!DOCTYPE html>
	<head>
	<title>" . AppTitle . " - " . AdminModule . "</title>
	<meta charset=\"utf-8\">
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
		<link rel=\"stylesheet\" href=\"../css/estilo.css\">  
	</head>
	<body>";
	include('class/menu.php');
	echo "			
		<h2>Bienvenido al m&oacute;dulo de administraci&oacute;n de SEL</h2>
		<h1>" . AddQuestions . "</h1>
		<h3>" . Method1 . "</h3>" . Method1Desc . "
		<h3>" . Method2 . "</h3>" . Method2Desc . "
		<h1>" . MakeQP . "</H1>" . MakeQPDesc . "	  
	</body>
	</html>";
} else {
	include_once 'login.php';
}
