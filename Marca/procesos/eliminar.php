<?php 
	
	require_once "../Clases/conexion.php";
	require_once "../Clases/crud.php"; 
	$obj= new crud();

	echo $obj->eliminar($_POST['id']);

 ?>