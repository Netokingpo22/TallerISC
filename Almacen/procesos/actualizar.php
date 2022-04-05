<?php 
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['nombreU'],
		$_POST['existenciaU'],
		$_POST['id']
				);

	echo $obj->actualizar($datos);	
 ?>