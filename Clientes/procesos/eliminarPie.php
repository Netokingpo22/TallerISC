<?php 
	
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php"; 
	$obj= new crud();

	echo $obj->eliminarPie($_POST['id']);

 ?>