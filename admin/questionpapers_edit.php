<?php

require_once 'config.inc.php';
require_once BASE_URL_ADMIN . '/db.php';
$db = Database::getInstance();

$j = 0;
for ($i = 0; $i < count($_REQUEST); $i++) {
	$qi = 'q' . $i;
	if (isset($_REQUEST[$qi]))
		if (is_numeric(($_REQUEST[$qi])) && $_REQUEST[$qi] <> 0)
			$j++;
}
session_start();
$sql = "UPDATE texamenes SET 
	fecha = '" . $_REQUEST['fecha'] . "',
	idusuario = " . $_SESSION['idusuario'] . ",
	claveexamen = '" . $_REQUEST['claveexamen'] . "',
	totalpreg = '" . $j . "',
	q0 = " . $_REQUEST['q0'] . ",
	q1=" . $_REQUEST['q1'] . ",
	q2=" . $_REQUEST['q2'] . ",
	q3=" . $_REQUEST['q3'] . ",
	q4=" . $_REQUEST['q4'] . ",
	q5=" . $_REQUEST['q5'] . ",
	q6=" . $_REQUEST['q6'] . ",
	q7=" . $_REQUEST['q7'] . ",
	q8=" . $_REQUEST['q8'] . ",
	q9=" . $_REQUEST['q9'] . ",
	q10=" . $_REQUEST['q10'] . ",
	q11=" . $_REQUEST['q11'] . ",
	q12=" . $_REQUEST['q12'] . ",
	q13=" . $_REQUEST['q13'] . ",
	q14=" . $_REQUEST['q14'] . ",
	q15=" . $_REQUEST['q15'] . ",
	q16=" . $_REQUEST['q16'] . ",
	q17=" . $_REQUEST['q17'] . ",
	q18=" . $_REQUEST['q18'] . ",
	q19=" . $_REQUEST['q19'] . "
	WHERE idexamen = '" . $_REQUEST['idexamen']. "' ; ";

if ($db->getPDO()->prepare($sql)->execute()) {
	echo "El examen se actualiz� correctamente <br> ";
	echo "<meta http-equiv=Refresh Content=\"1; url=questionpapers_form.php\">";
} else
	echo "Error al intentar guardar el examen <br> ";

?>