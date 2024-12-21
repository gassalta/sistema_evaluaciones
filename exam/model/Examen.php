<?php

error_reporting(-1);
ini_set('display_errors', -1);
error_reporting(E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

class Examen
{
	public $sessionid;
	private $db, $twig;

	public function __construct(Database $db, \Twig\Environment $twig)
	{
		$this->db = $db;
        $this->twig = $twig;
	}

	function login_form($message = "", $clave_examen = "")
	{
		$sessionid = rand();
		// Renderiza la plantilla Twig y pasa las variables
		return $this->twig->render('form.html.twig', [
			'AppTitle' => traducir_cadena("AppTitle"),
			'ExamModule' => traducir_cadena("ExamModule"),
			'Institute' => traducir_cadena("Institute"),
			'WelcomeExam' => traducir_cadena("WelcomeExam"),
			'Instructions' => traducir_cadena("Instructions"),
			'message' => traducir_cadena($message),
			'txtsessionid' => traducir_cadena("txtsessionid"),
			'randval' => $sessionid,
			'txtstudentid' => traducir_cadena("txtstudentid"),
			'txtidexamen' =>  $clave_examen,
			'txtquestionpaperid' => traducir_cadena("txtquestionpaperid"),
			'txtsubmit' => traducir_cadena("txtsubmit"),
			'txtreset' => traducir_cadena("txtreset"),
			'password' => traducir_cadena("password"),
		]);
	}

	function login($clave)
	{
		$Nro_control = $_POST["numcontrol"];
		$Id_examen = $_POST["idexamen"];

		$sqllogin = "SELECT idalumno, numcontrol, nombre FROM talumnos WHERE numcontrol = '{$Nro_control}' LIMIT 1;";
		$consulta = $this->db->getPDO()->prepare($sqllogin);
		$consulta->execute();
		if ($consulta->rowCount() != 0) {

			while ($fila = $consulta->fetch(PDO::FETCH_OBJ)) {
				$idalumno = $fila->idalumno;

				$sqllogin = "SELECT idexamen FROM texamenes WHERE claveexamen = '{$Id_examen}' LIMIT 1;";
				$qConsulta = $this->db->getPDO()->prepare($sqllogin);
				$qConsulta->execute();
				if ($qConsulta->rowCount() != 0) {

					while ($fila2 = $qConsulta->fetch(PDO::FETCH_OBJ)) {
						$idexamen = $fila2->idexamen;

						$sExam = "SELECT idexamen FROM tans1 WHERE idalumno= " . $idalumno . " AND idexamen = " . $idexamen;
						$req = $this->db->getPDO()->prepare($sExam);
						$req->execute();
						if ($req->rowCount() != 0) {
							return $this->login_form(traducir_cadena("already_registered"));
							exit;
						}

						setcookie("logged", $_POST["sessionid"]);
						session_start();
						$_SESSION['alumno'] = 'registered';

						$_SESSION['sessionid'] = $_POST["sessionid"];
						$_SESSION['numcontrol'] = $Nro_control;
						$_SESSION['idexamen'] = $Id_examen;

						header("Location: exam.php");
					}
				} else {
					return $this->login_form(traducir_cadena(FORM_ERROR), $clave);
				}
			}
		} else {
			return $this->login_form(traducir_cadena(FORM_ERROR), $clave);
		}
	}

	function logout()
	{
		session_start();
		setcookie("logged", 0);
		session_destroy();
		header("Location: index.php");
	}
}
