<?php 
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST["cliente"],
		$_POST["marca"],
		$_POST["modelo"],
		$_POST["año"]
				);
	echo $obj->agregarV($datos);
