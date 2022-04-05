<?php 

class crud{
	public function agregar($datos){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT into servicio (Nombre, Costo) 
		values ('$datos[0]','$datos[1]')";
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($id){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT * from servicio where ID='$id'";
		$result=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($result);

		$datos=array(
			'id' => $ver[0],
			'nombre' => $ver[1],
			'costo' => $ver[2]
		);
		return $datos;
	}

	public function actualizar($datos){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE servicio SET Nombre='$datos[0]',
		Costo='$datos[1]'
		where ID='$datos[2]'";
		return mysqli_query($conexion,$sql);
	}
	
	public function eliminar($id){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE servicio set Visible='0' where ID='$id'";
		return mysqli_query($conexion,$sql);
	}
}

?>