<?php 
	
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud2.php";

	$obj= new crud();

	echo json_encode($obj->obtenDatos());

 ?>