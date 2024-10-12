<?php

error_reporting(-1);
ini_set('display_errors', -1);
error_reporting(E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

require_once('../admin/config.inc.php');
require_once('../admin/db.php');
include_once('../admin/funciones.php');

$langfile = "../lang/" . $language . ".php";
if (!file_exists($langfile)) {
	rep_error(FILE_NOT_FOUND);
	exit;
}

include($langfile);
require('../admin/class/Template.php');  //no tiene que ver el directorio donde se encuentre

class moduloexamen
{
	var $sessionid;
	private $db;

	function __construct()
	{
		$this->db = mysqli_connect('localhost', 'root', '', 'seldb');
	}

	function login_form($message = "", $clave_examen = "")
	{
		$tpl = new template("templates/");
		$tpl->load("form.html");
		$tpl->set_block("form");
		$tpl->set_variable("AppTitle", traducir_cadena("AppTitle"));
		$tpl->set_variable("ExamModule", traducir_cadena("ExamModule"));
		$tpl->set_variable("Institute", traducir_cadena("Institute"));
		$tpl->set_variable("WelcomeExam", traducir_cadena("WelcomeExam"));
		$tpl->set_variable("Instructions", traducir_cadena("Instructions"));
		$tpl->set_variable("message", $message);
		$tpl->set_variable("txtsessionid", traducir_cadena("txtsessionid"));
		$sessionid = rand();
		$tpl->set_variable("randval", $sessionid);
		$tpl->set_variable("txtstudentid", traducir_cadena("txtstudentid"));
		$tpl->set_variable("txtidexamen", $clave_examen);
		$tpl->set_variable("txtquestionpaperid", traducir_cadena("txtquestionpaperid"));
		$tpl->set_variable("txtsubmit", traducir_cadena("txtsubmit"));
		$tpl->set_variable("txtreset", traducir_cadena("txtreset"));
		$tpl->set_variable("password", traducir_cadena("password"));
		$tpl->parse_block("form");
		return $tpl->get();
	}

	function login($clave)
	{
		$Nro_control = $_POST["numcontrol"];
		$Id_examen = $_POST["idexamen"];

		$sqllogin = "SELECT idalumno, numcontrol, nombre FROM talumnos WHERE numcontrol = '{$Nro_control}' LIMIT 1;";
		$qConsulta = mysqli_query($this->db, $sqllogin);
		if ($qConsulta) {
			while ($fila = mysqli_fetch_object($qConsulta)) {
				$idalumno = $fila->idalumno;
				mysqli_free_result($qConsulta);

				$sqllogin = "SELECT idexamen FROM texamenes WHERE claveexamen = '{$Id_examen}' LIMIT 1;";
				$qConsulta = mysqli_query($this->db, $sqllogin) or die("error: " . $sqllogin);
				if ($qConsulta) {
					while ($fila2 = mysqli_fetch_object($qConsulta)) {
						$idexamen = $fila2->idexamen;

						$sExam = "SELECT idexamen FROM tans1 WHERE idalumno= " . $idalumno . " AND idexamen = " . $idexamen;
						$req = mysqli_query($this->db, $sExam) or die("error: " . $sExam);
						if (mysqli_fetch_object($req)) {
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
