<?php 

class crud{
	public function agregar($datos){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT into piezas (Nombre, Existencia) 
		values ('$datos[0]','$datos[1]')";
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($id){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT * from piezas where ID='$id'";
		$result=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($result);

		$datos=array(
			'id' => $ver[0],
			'nombre' => $ver[1],
			'existencia' => $ver[3]
		);
		return $datos;
	}

	public function actualizar($datos){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE piezas SET Nombre='$datos[0]',
		Existencia='$datos[1]'
		where ID='$datos[2]'";
		return mysqli_query($conexion,$sql);
	}
	
	public function eliminar($id){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE piezas set Visible='0' where ID='$id'";
		return mysqli_query($conexion,$sql);
	}
}

?>