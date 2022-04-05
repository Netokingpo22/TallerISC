<?php 
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['empresa'],
		$_POST['nombre'],
		$_POST['apellido'],
		$_POST['celular']
	);

	echo $obj->agregar($datos);
 ?>