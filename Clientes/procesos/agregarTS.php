<?php 
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['id'],
		$_POST['ser'],
		$_POST['veh']
				);

	echo $obj->agregarTS($datos);
 ?>