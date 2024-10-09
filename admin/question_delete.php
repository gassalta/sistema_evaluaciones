<?php 

session_start();
if  ($_SESSION['admin'] == 'registered'){

	  include('db.php');
	  
	  $query = "DELETE from tbancopreguntas WHERE idpregunta = " . $_REQUEST['id'];		
	  if (mysqli_query($base_selection,$query)) {
	  	 echo " 1 pregunta eliminada...";
		 echo "<meta http-equiv=Refresh Content=\"1; url=listquestion_by_subject.php?idmateria=".$_REQUEST['idmateria']."\">";
	  }
	  else { 
	  	 echo "error al eliminar el registro...<br/>"; 
	  	 echo $query;
	  }
}
?>