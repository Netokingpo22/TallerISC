<?php 
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['empresaU'],
		$_POST['nombreU'],
		$_POST['apellidoU'],
		$_POST['celularU'],
		$_POST['id']
				);

	echo $obj->actualizar($datos);	
 ?>