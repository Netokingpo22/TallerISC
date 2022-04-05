<?php 
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['nombre'],
		$_POST['apellido'],
		$_POST['celular'],
		$_POST['correo']
				);

	echo $obj->agregar($datos);
 ?>