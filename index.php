<?php
		if(isset($_GET['evid']))
		{
			$clave = 'unidad'.$_GET['evid'];
			header ("location: exam/?evid=$clave");
		}
		else
			header ("location: exam/");		
?>