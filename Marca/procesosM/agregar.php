<?php 
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['id'],
		$_POST['nombre']
	);

	echo $obj->agregarM($datos);
 ?>