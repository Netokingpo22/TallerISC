<?php

class crud
{
	public function agregarM($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "INSERT into modelo (Marca,Nombre) values ('$datos[0]','$datos[1]')";
		return mysqli_query($conexion, $sql);
	}
	public function agregar($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "INSERT into marca (Nombre) values ('$datos[0]')";
		return mysqli_query($conexion, $sql);
	}

	public function tablaM($IDD)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "SELECT * from modelo where Marca='$IDD' AND Visible='1'";
		$result = mysqli_query($conexion, $sql);

		while ($ver = mysqli_fetch_array($result)) {
			$datos[][] = array(
				'id' => $ver[0],
				'marca' => $ver[1],
				'nombre' => $ver[2],
				'año' => $ver[3]
			);
		}
		return $datos;
	}

	public function obtenDatos($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "SELECT * from marca where ID='$id'";
		$result = mysqli_query($conexion, $sql);
		$ver = mysqli_fetch_row($result);

		$datos = array(
			'id' => $ver[0],
			'nombre' => $ver[1]
		);
		return $datos;
	}
	public function obtenDatosM($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "SELECT * from modelo where ID='$id'";
		$result = mysqli_query($conexion, $sql);
		$ver = mysqli_fetch_row($result);

		$datos = array(
			'id' => $ver[0],
			'nombre' => $ver[2],
			'año' => $ver[3]
		);
		return $datos;
	}

	public function actualizar($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "UPDATE marca SET Nombre='$datos[0]'
		where ID='$datos[1]'";
		return mysqli_query($conexion, $sql);
	}
	public function actualizarM($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "UPDATE modelo SET Nombre='$datos[1]'
		where ID='$datos[0]'";
		return mysqli_query($conexion, $sql);
	}

	public function eliminar($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "UPDATE marca set Visible='0' where ID='$id'";
		return mysqli_query($conexion, $sql);
	}

	public function eliminarM($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "UPDATE modelo set Visible='0' where ID='$id'";
		return mysqli_query($conexion, $sql);
	}
}
