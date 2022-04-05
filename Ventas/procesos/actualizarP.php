<?php 
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['idU'],
		$_POST['costocU'],
		$_POST['costopU']
				);

	echo $obj->actualizarP($datos);
