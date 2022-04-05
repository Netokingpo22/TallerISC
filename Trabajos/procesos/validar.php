<?php 
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['nom'],
		$_POST['con']
				);

	echo $obj->validar($datos);	
 ?>