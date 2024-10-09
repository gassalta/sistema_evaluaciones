<?php
/*
 * createexam2.php : modulo de examen 
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>

 * Basado en phpexam de Senthil Nayagam
 * http://sourceforge.net/projects/phpexam/
 
 * <c> 2004 SEL-0.2beta
 */ 
 
include('db.php');
require ('funciones.php');
$langfile = '../lang/'.$language.'.php';

if (!file_exists($langfile)){
  rep_error(FileNotFound);
  exit;  
}

include ($langfile);

echo "
<html>
<head>
<title>".AppTitle."</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<link rel=\"stylesheet\" href=\"../css/estilo.css\">
</head>

<frameset cols=\"50%,50%\" frameborder=\"NO\" border=\"0\" framespacing=\"0\" rows=\"*\">
	<frame name=\"leftFrame\" scrolling=\"YES\" noresize src=\"listquestion_by_subject.php?idmateria=".$_REQUEST['idmateria']."\">
	<frame name=\"rightFrame\" marginwidth=\"10\" src=\"questionpapers_form.php?idmateria=".$_REQUEST['idmateria']."\">
</frameset>

<noframes>
<body >
</body>
</noframes>
</html>";
