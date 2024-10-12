<?php

require_once('config.inc.php');
$base_selection = mysqli_connect($servidor, $usuario, $password, $basedatos);
$mysqli = new mysqli('localhost', 'root', '', 'seldb');
//$base_selection = mysqli_select_db($basedatos,$db_connect);
/*lenguajes disponibles: english, spanish*/
$language = "spanish";
