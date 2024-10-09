<?php
/*
 * functions.php : modulo de examen 
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>

 * Basado en phpexam de Senthil Nayagam
 * http://sourceforge.net/projects/phpexam/
 
 * <c> 2004 SEL-0.2beta
 */ 

function rep_error($message) {
		echo "<b>Error: </b>".$message;
	}	

function traducir_cadena ($string)
{
	if (defined($string)) 
	{
		return constant($string);
	} 
	else 
	{
		return $string;
	}
}	

function make_seed() {
		list($usec, $sec) = explode(' ', microtime());
		return (float) $sec + ((float) $usec * 100000);
	}
  
  function existe($randval,$arreglo){
	$nelem = count($arreglo);
	$n=0; $exis=false;
	while (!$exis and $n<=$nelem) {
		if ($arreglo[$n]==$randval){
			$exis=true;
			}
		else {
			$exis=false;
			$n++;
			}
		}
	return $exis;	
	}
  
  function generar($arreglo){
	$nelem=count($arreglo);
	$listo = false; $n=0;
	while (!$listo) {
		$randval = rand(1,20);
		if (!existe($randval,$arreglo)) {			
			$arreglo[$n] = $randval;
			$n++;
			if ($n == $nelem) {
				$listo=true;
				}
			}
		}	
	}
	
	function mostrar($arreglo){
		$nelem=count($arreglo);
		for ($n=0; $n<$nelem; $n++){
			echo "arreglo[".$n."]= ".$arreglo[$n].", ";
			}
		}
