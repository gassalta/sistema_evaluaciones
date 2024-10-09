<?php
/*
 * question_edit.php : modulo de examen 
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>

 * Basado en phpexam de Senthil Nayagam
 * http://sourceforge.net/projects/phpexam/
 
 * <c> 2004 SEL-0.2beta
 */ 
	require_once ('config.inc.php');
	$langfile = "../lang/".$language.".php";
	require_once ($langfile);
	
	echo "<link rel=\"stylesheet\" href=\"../css/estilo.css\"/>";
		
	  include('menu.php');
	  include('db.php');
	  
	  $query = "UPDATE tbancopreguntas SET ";
		$query.= "idmateria = " . $_REQUEST['idmateria'] . ", ";
		$query.= "unidad = '" . $_REQUEST['unidad'] . "', ";												
		$query.= "pregunta = '" . htmlentities($_REQUEST['pregunta']) . "', ";
		$query.= "opcion1 = '" . htmlentities($_REQUEST['opcion1']) . "', ";
		$query.= "opcion2 = '" . htmlentities($_REQUEST['opcion2']) . "', ";
		$query.= "opcion3 = '" . htmlentities($_REQUEST['opcion3']) . "', ";								
		$query.= "opcion4 = '" . htmlentities($_REQUEST['opcion4']) . "', ";								
		$query.= "respuesta = " . $_REQUEST['respuesta'];		
		$query.= " WHERE idpregunta = " . $_REQUEST['id'];		
	  if (mysqli_query($base_selection,$query)) {
	  	 echo "pregunta modificada correctamente";
	  	if($_REQUEST['action'] == 'edit') 
		 		echo "<meta http-equiv=Refresh Content=\"1; url=createexam2.php?idmateria=".$_REQUEST['idmateria']."\">";
			else
		 		echo "<meta http-equiv=Refresh Content=\"1; url=questionform.php?idmateria=".$_REQUEST['idmateria']."\">";
	  }
	  else { 
	  	 echo "error al modificar el registro...<br/>"; 
	  	 echo $query;
	  }
?>