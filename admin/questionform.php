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

	$questionid = "";
	$subjectidedit = "";
	$question = "";
	$choice1 = "";
	$choice2 = "";
	$choice3 = "";
	$choice4 = "";
	$answer = "";
	$unit = "";

	if (isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
	} else
		$action = 'insert';

	if ($action == 'edit') {
		$query =  "SELECT * FROM tbancopreguntas WHERE idpregunta='" . $_REQUEST['id'] . "' ORDER BY idpregunta ASC";
		$req1 = $db->getPDO()->prepare($query);
		$req1->execute();

		while ($row = $req1->fetch(PDO::FETCH_OBJ)) {
			$questionid = $row->idpregunta;
			$subjectidedit = $row->idmateria;
			$question = $row->pregunta;
			$choice1 = $row->opcion1;
			$choice2 = $row->opcion2;
			$choice3 = $row->opcion3;
			$choice4 = $row->opcion4;
			$answer = $row->respuesta;
			$unit = $row->unidad;
		}
	} elseif (isset($_REQUEST['idmateria'])) {
		$subjectidedit = $_REQUEST['idmateria'];
		if (isset($_REQUEST['idunidad']))
			$unit = $_REQUEST['idunidad'];
		else
			$unit = 1;
	}
?>
	<html>

	<head>
		<?php echo "<title>" . AppTitle . " - " . AdminModule . "</title>"; ?>
		<link rel="stylesheet" href="../css/estilo.css" />
		<script type="text/javascript" src="js/ajax.js"></script>
	</head>

	<body>
		<?php include BASE_URL_ADMIN . '/class/menu.php'; ?>
		<h2>Agregar una pregunta por formulario</h2>
		<h3>Banco de preguntas</h3>

		<form name="formz" method="post" action="question_<?php echo $action ?>.php?action=<?php echo $action ?>">
			<table border="1" width="90%">
				<tr>
					<td class="bgblue">Campo</td>
					<td class="bgblue">Entrada</td>
				</tr>
				<tr>
					<td class="bggray">materia</td>
					<td>
						<?php
						$query = "SELECT * FROM tmaterias";
						$req1 = $db->getPDO()->prepare($query);
						$req1->execute();
						$datos = $req1->fetchAll(PDO::FETCH_OBJ);
						echo
						"<select name=\"idmateria\" id=\"select1\" onchange='cargaContenido(this.id)'>\n";
						echo "<option value=\"\">" . SelSub . "</option>\n";
						foreach ($datos as $row) {
							$subjectid = $row->idmateria;
							$subject = $row->nombre;
							echo "<option value=\"$subjectid\"";
							if ((($action == 'edit') || ($action == 'insert')) && ($subjectidedit == $subjectid)) echo "selected";
							echo ">$subject</option>\n";
						};
						echo "</select>";
						?> </td>
				</tr>
				<tr>
					<td class="bggray">unidad</td>
					<td>
						<?php
						if (($action == 'edit') || !(isset($subjectidedit))) {
							$sql = "SELECT unidades FROM tmaterias WHERE idmateria = '$subjectidedit'";
							$req = $db->getPDO()->prepare($sql);
							$req->execute();

							$i = 1;
							$registro = $req->fetch(PDO::FETCH_NUM);
							$total = $registro[0];
							
							echo "<select name='unidad' id='select2'>";
							while ($total >= $i) {
								echo "<option value=\"$i\"";
								if ($i == $unit) echo "selected";
								echo ">Unidad " . $i . "</option>\n";
								$i++;
							}
							echo "</select>";
						} else { ?>
							<select disabled="disabled" name="unidad" id="select2">
								<option value="0">seleccione una Unidad...</option>
							</select>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td class="bggray">pregunta</td>
					<td><textarea name="pregunta" cols="70" rows="5"><?php echo $question ?></textarea></td>
				</tr>
				<tr>
					<td class="bggray">opcion1</td>
					<td><input type="text" name="opcion1" maxlength="100" size="80" value="<?php echo $choice1 ?>" /></td>
				</tr>
				<tr>
					<td class="bggray">opcion2</td>
					<td><input type="text" name="opcion2" maxlength="100" size="80" value="<?php echo $choice2 ?>" /></td>
				</tr>
				<tr>
					<td class="bggray">opcion3</td>
					<td><input type="text" name="opcion3" maxlength="100" size="80" value="<?php echo $choice3 ?>" /></td>
				</tr>
				<tr>
					<td class="bggray">opcion4</td>
					<td><input type="text" name="opcion4" maxlength="100" size="80" value="<?php echo $choice4 ?>" /></td>
				</tr>
				<tr>
					<td class="bggray">respuesta</td>
					<td><input type="text" name="respuesta" size="4" value="<?php echo $answer ?>" /></td>
				</tr>

			</table>
			<br />
			<input type="hidden" name="id" value="<?php echo $questionid; ?>" />
			<input type="submit" name="Submit" value="Guardar" />
			<?php if (($action == 'edit') || isset($idmateria)) { ?>
				<input type="button" onclick="history.back(-1);" value="Cancelar" />
			<?php } else { ?>
				<input type="button" onclick="top.frames.location='index.php'" value="Cancelar" />
			<?php } ?>
		</form>
	</body>

	</html>
<?php
} else {
	header('Location: login.php');
}

?>