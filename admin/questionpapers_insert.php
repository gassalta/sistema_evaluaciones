<?php
include('db.php');

$j = 0;
for($i=0; $i < count($_REQUEST); $i++) {
	$qi = 'q'.$i;
	if(isset($_REQUEST[$qi]))
		if(is_numeric(($_REQUEST[$qi])) && ($_REQUEST[$qi] <> 0))
			$j++;
}

session_start();
$sql = "INSERT INTO texamenes (fecha, idusuario, claveexamen, idmateria, totalpreg,
					q0,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13,q14,q15,q16,q17,q18,q19) 
					VALUES('".$_REQUEST['fecha'] ."',". $_SESSION['idusuario'] .",'". $_REQUEST['claveexamen'] ."','". 
					$_REQUEST['idmateria'] ."',". $j .",'" .
					$_REQUEST['q0'] ."','". $_REQUEST['q1'] ."','". $_REQUEST['q2'] ."','". $_REQUEST['q3'] ."','".
					$_REQUEST['q4'] ."','". $_REQUEST['q5'] ."','". $_REQUEST['q6'] ."','". $_REQUEST['q7'] ."','". 
					$_REQUEST['q8'] ."','". $_REQUEST['q9'] ."','". $_REQUEST['q10'] ."','". $_REQUEST['q11'] ."','". 
					$_REQUEST['q12'] ."','". $_REQUEST['q13'] ."','". $_REQUEST['q14'] ."','". $_REQUEST['q15'] ."','". 
					$_REQUEST['q16'] ."','". $_REQUEST['q17'] ."','". $_REQUEST['q18'] ."','". $_REQUEST['q19'] ."')";
					
if(mysqli_query($base_selection,$sql)) {
	echo "El examen se guardo correctamente <br> ";
	echo "<meta http-equiv=Refresh Content=\"2; url=questionpapers_form.php\">";	
}
else
	echo "Error al intentar crear el examen <br> " . $sql;
