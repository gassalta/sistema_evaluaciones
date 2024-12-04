<?php
require_once 'config.inc.php';
require_once BASE_URL_ADMIN . '/db.php';
$db = Database::getInstance();

require_once BASE_URL_ADMIN . '/funciones.php';

// Archivo de idioma
$langfile = BASE_URL . "/lang/" . $language . ".php";
require_once($langfile);

if (!file_exists($langfile)) {
  rep_error(FILE_NOT_FOUND);
  exit;
}


echo "
<html>
<head>
<title>" . AppTitle . "</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<link rel=\"stylesheet\" href=\"../css/estilo.css\">
</head>

<frameset cols=\"50%,50%\" frameborder=\"NO\" border=\"0\" framespacing=\"0\" rows=\"*\">
	<frame name=\"leftFrame\" scrolling=\"YES\" noresize src=\"listquestion_by_subject.php?idmateria=" . $_REQUEST['idmateria'] . "\">
	<frame name=\"rightFrame\" marginwidth=\"10\" src=\"questionpapers_form.php?idmateria=" . $_REQUEST['idmateria'] . "\">
</frameset>

<noframes>
<body >
</body>
</noframes>
</html>";
