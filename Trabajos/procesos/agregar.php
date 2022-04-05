<?php 
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['nombre'],
		$_POST['costo']
	);

	echo $obj->agregar($datos);
 ?>