<?php

class crud
{
	public function agregar($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "INSERT into proveedor (Empresa, Nombre, Apellido, Celular) 
		values ('$datos[0]','$datos[1]','$datos[2]','" . $datos[3] . "')";
		return mysqli_query($conexion, $sql);
	}
	public function agregarP($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "INSERT into idpiezas (Pieza, Proveedor, CostoC, CostoP) 
		values ('$datos[1]','$datos[0]','$datos[2]','" . $datos[3] . "')";
		return mysqli_query($conexion, $sql);
	}
	public function agregarPe($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql1 = "SELECT CostoP FROM idpiezas WHERE Pieza = $datos[1]";
		$query = $conexion->query($sql1);
		$cos = mysqli_fetch_array($query);
		$coss = (($cos[0] * $datos[2]));

		$sql = "INSERT into pedido (Proveedor, Pieza, Cantidad, Costo) 
		values ('$datos[0]','$datos[1]','$datos[2]','$coss')";
		return mysqli_query($conexion, $sql);
	}

	public function obtenDatos($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "SELECT * from proveedor where ID='$id'";
		$result = mysqli_query($conexion, $sql);
		$ver = mysqli_fetch_row($result);

		$datos = array(
			'id' => $ver[0],
			'empresa' => $ver[1],
			'nombre' => $ver[2],
			'apellido' => $ver[3],
			'celular' => $ver[4]
		);
		return $datos;
	}

	public function obtenDatosP($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "SELECT * from piezas where ID='$id'";
		$result = mysqli_query($conexion, $sql);
		$ver = mysqli_fetch_row($result);
		$sql = "SELECT CostoC from idpiezas where Pieza='$id'";
		$result = mysqli_query($conexion, $sql);
		$ver1 = mysqli_fetch_row($result);
		$sql = "SELECT CostoP from idpiezas where Pieza='$id'";
		$result = mysqli_query($conexion, $sql);
		$ver2 = mysqli_fetch_row($result);

		$datos = array(
			'id' => $ver[0],
			'costoc' => $ver1[0],
			'costop' => $ver2[0]
		);
		return $datos;
	}

	public function obtenDatosPe($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "SELECT * from pedido where ID='$id'";
		$result = mysqli_query($conexion, $sql);
		$ver = mysqli_fetch_row($result);

		$datos = array(
			'id' => $ver[0],
			'pieza' => $ver[3],
			'cantidad' => $ver[4]
		);
		return $datos;
	}

	public function actualizar($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "UPDATE proveedor SET Empresa='$datos[0]',
		Nombre='$datos[1]',
		Apellido='$datos[2]',
		Celular='$datos[3]'
		where ID='$datos[4]'";
		return mysqli_query($conexion, $sql);
	}

	public function actualizarP($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "UPDATE idpiezas SET CostoC='$datos[1]',
		CostoP='$datos[2]'
		where Pieza='$datos[0]'";
		return mysqli_query($conexion, $sql);
	}

	public function actualizarPe($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "UPDATE pedido SET Cantidad='$datos[1]',
		Costo='$datos[2]'
		where ID='$datos[0]'";
		return mysqli_query($conexion, $sql);
	}

	public function eliminar($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "UPDATE proveedor set Visible='0' where ID='$id'";
		return mysqli_query($conexion, $sql);
	}

	public function eliminarP($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "UPDATE piezas set Visible='0' where ID='$id'";
		return mysqli_query($conexion, $sql);
	}

	public function finalizar($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql1 = "SELECT Pieza FROM pedido WHERE ID = $id";
		$query = $conexion->query($sql1);
		$cos = mysqli_fetch_array($query);
		$sql3 = "SELECT Cantidad FROM pedido WHERE ID = $id";
		$query3 = $conexion->query($sql3);
		$cos3 = mysqli_fetch_array($query3);
		$sql2 = "SELECT Existencia FROM piezas WHERE ID = $cos[0]";
		$query2 = $conexion->query($sql2);
		$cos2 = mysqli_fetch_array($query2);
		$coss = (($cos3[0] + $cos2[0]));

		$sql4 = "UPDATE piezas set Existencia=$coss where ID='$cos[0]'";
		mysqli_query($conexion, $sql4);
		$sql = "UPDATE pedido set Estado='0' where ID='$id'";
		return mysqli_query($conexion, $sql);
	}

	public function eliminarPe($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "DELETE FROM pedido where ID='$id'";
		return mysqli_query($conexion, $sql);
	}
}
