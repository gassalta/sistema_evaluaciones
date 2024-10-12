<?php

require_once('db.php');
require_once('funciones.php');

require_once 'class/Login.php';

$langfile = "../lang/" . $language . ".php";

if (!file_exists($langfile)) {
	rep_error(FILE_NOT_FOUND);
	exit;
}
include($langfile);
require_once 'class/Template.php';


$modadmin = new moduloadmin();
if (isset($_REQUEST["action"])) {
	if ($_REQUEST["action"] == "login") {
		echo $modadmin->login();
	} else {
		if ($_REQUEST["action"] == "logout") {
			echo $modadmin->logout();
		}
	}
} else {
	echo $modadmin->login_form(traducir_cadena(LOGIN_DATA));
}
