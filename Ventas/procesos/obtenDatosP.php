<?php 
	
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php";

	$obj= new crud();

	echo json_encode($obj->obtenDatosP($_POST['id']));

 ?>