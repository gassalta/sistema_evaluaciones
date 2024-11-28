<?php

function validaSelect($selectDestino)
{
	global $listadoSelects;
	if (isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	if (is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino = $_GET["select"];
$opcionSeleccionada = $_GET["opcion"];

if (validaOpcion($opcionSeleccionada)) {
	require_once 'config.inc.php';
	require_once BASE_URL_ADMIN . '/db.php';
	$db = Database::getInstance();
	$query = "SELECT unidades FROM tmaterias WHERE idmateria = '$opcionSeleccionada'";

	$req = $db->getPDO()->prepare($query);
	$req->execute();
	$datos = $req->fetchAll(PDO::FETCH_OBJ);

	echo "<select name='unidad' id='" . $selectDestino . "'>";
	echo "<option value='0'>seleccione una Unidad...</option>";
	$i = 1;
	$registro = $datos;
	$total = $registro[0];
	while ($total >= $i) {
		echo "<option value='" . $i . "'>Unidad " . $i . "</option>";
		$i++;
	}
	echo "</select>";
}
