<?php 
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['proveedor'],
		$_POST['pieza'],
		$_POST['costoc'],
		$_POST['costop']
	);

	echo $obj->agregarP($datos);
 ?>