<?php

/*
 * upload.php : modulo de administracion 
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>
 * <c> 2004 SEL-0.1beta
 */ 



include('db.php');

if($file != NULL) { 

$fp=fopen($file, "r");
while ($data = fgetcsv ($fp, 1000, ",")) { 
    $num = count ($data);    
    $path=$data[0];
    $idmateria=$data[1];
    $pregunta=$data[2];
    $opcion1=$data[3];
    $opcion2=$data[4];
    $opcion3=$data[5];
    $opcion4=$data[6];
    $respuesta =$data[7];    
       
    print $path."/".$filename.",".$filesize." <br>\n";
    @mysql_query("INSERT INTO tbancopreguntas(idmateria,pregunta,opcion1,opcion2,opcion3,opcion4,respuesta) 
							VALUES('$idmateria','$pregunta','$opcion1','$opcion2','$opcion3','$opcion4','$respuesta')");        
	}    
	fclose ($fp);        
} 
?>
<html>
<head>
<title>Archivo cargado correctamente!</title>
<body>

<h1>Correcto!</h1>

<P>Enviaste: <? echo "<b>$file_name </b>"; ?>, de <? echo "$file_size"; ?> 
bytes, archivo tipo <? echo "$file_type"; ?>.</p>

</body>
</html> 