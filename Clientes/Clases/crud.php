<?php

class crud
{
	public function agregar($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "INSERT into cliente (Nombre,Apellido,Celular,Correo)
		values ('$datos[0]',
		'$datos[1]',
		'$datos[2]',
		'$datos[3]')";
		return mysqli_query($conexion, $sql);
	}

	public function agregarV($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "INSERT into vehiculo (Cliente,Marca,Modelo,Año)
		values ('$datos[0]',
		'$datos[1]',
		'$datos[2]',
		'$datos[3]')";
		return mysqli_query($conexion, $sql);
	}

	public function agregarT($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "INSERT into idtrabajo (Vehiculo)
		values ('$datos')";
		return mysqli_query($conexion, $sql);
	}

	public function agregarTS($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql1 = "SELECT Costo FROM servicio WHERE ID = $datos[1]";
		$query = $conexion->query($sql1);
		$cost = mysqli_fetch_array($query);

		$sql = "INSERT into trabajo (Trabajo,Servicio,Vehiculo,CostoT)
		values ('$datos[0]','$datos[1]','$datos[2]','$cost[0]')";

		return mysqli_query($conexion, $sql);
	}

	public function agregarSP($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql1 = "SELECT Existencia FROM piezas WHERE ID = $datos[1]";
		$query = $conexion->query($sql1);
		$exist = mysqli_fetch_array($query);
		$cantidad = ($exist[0] - $datos[2]);
		$sql = "UPDATE piezas set Existencia='$cantidad' where ID='$datos[1]'";
		mysqli_query($conexion, $sql);

		$sql = "INSERT into piezasser (Trabajo,Piezas,Cantidad)
		values ('$datos[0]','$datos[1]','$datos[2]')";

		return mysqli_query($conexion, $sql);
	}

	public function obtenDatos($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "SELECT * from cliente where ID='$id'";
		$result = mysqli_query($conexion, $sql);
		$ver = mysqli_fetch_row($result);

		$datos = array(
			'id' => $ver[0],
			'nombre' => $ver[1],
			'apellido' => $ver[2],
			'celular' => $ver[3],
			'correo' => $ver[4]
		);
		return $datos;
	}

	public function modelos($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "SELECT * from modelo where Marca=$id and Visible=1";
		$result = mysqli_query($conexion, $sql);

		$i = 0;
		while ($mostrar = mysqli_fetch_row($result)) {
			$datos[$i] = array(
				'id' => $mostrar[0],
				'marca' => $mostrar[1],
				'nombre' => $mostrar[2],
				'año' => $mostrar[3]
			);
			$i++;
		}
		return $datos;
	}

	public function actualizar($datos)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "UPDATE cliente SET Nombre='$datos[0]',
		Apellido='$datos[1]',
		Celular='$datos[2]',
		Correo='$datos[3]'
		where ID='$datos[4]'";
		return mysqli_query($conexion, $sql);
	}

	public function eliminar($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "UPDATE cliente set Visible='0' where ID='$id'";
		return mysqli_query($conexion, $sql);
	}

	public function eliminarV($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql = "UPDATE vehiculo set Estado='0' where ID='$id'";
		return mysqli_query($conexion, $sql);
	}

	public function eliminarTs($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql1 = "SELECT Piezas FROM piezasser WHERE Trabajo = $id";
		$result = mysqli_query($conexion, $sql1);
		while ($mostrar = mysqli_fetch_row($result)) {
			$sql1 = "SELECT Cantidad FROM piezasser WHERE Trabajo = $id";
			$query = $conexion->query($sql1);
			$cantidad = mysqli_fetch_array($query);
			$sql1 = "SELECT Existencia FROM piezas WHERE ID = $mostrar[0]";
			$query = $conexion->query($sql1);
			$exist = mysqli_fetch_array($query);
			$suma = ($cantidad[0] + $exist[0]);
			$sql = "UPDATE piezas set Existencia=$suma where ID='$mostrar[0]'";
			mysqli_query($conexion, $sql);
		}
		$sql = "DELETE FROM piezasser where Trabajo='$id'";
		$sql = "DELETE FROM trabajo where ID='$id'";
		return mysqli_query($conexion, $sql);
	}

	public function eliminarT($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql1 = "SELECT ID FROM trabajo WHERE Trabajo = $id";
		$result = mysqli_query($conexion, $sql1);
		while ($mostrar = mysqli_fetch_row($result)) {

			$sql1 = "SELECT Piezas FROM piezasser WHERE Trabajo = $mostrar[0]";
			$query = $conexion->query($sql1);
			$pieza = mysqli_fetch_array($query);
			$sql1 = "SELECT Cantidad FROM piezasser WHERE Trabajo = $mostrar[0]";
			$query = $conexion->query($sql1);
			$cantidad = mysqli_fetch_array($query);
			if ($pieza == NULL) {
			} else {
				$sql1 = "SELECT Existencia FROM piezas WHERE ID = $pieza[0]";
				$query = $conexion->query($sql1);
				$exist = mysqli_fetch_array($query);
				$suma = ($cantidad[0] + $exist[0]);
				$sql = "UPDATE piezas set Existencia=$suma where ID='$pieza[0]'";
				mysqli_query($conexion, $sql);
			}
			$sql1 = "DELETE FROM piezasser where Trabajo='$mostrar[0]'";
			mysqli_query($conexion, $sql1);
			$sql1 = "DELETE FROM trabajo where Trabajo='$id'";
			mysqli_query($conexion, $sql1);
		}
		$sql = "DELETE FROM idtrabajo where ID='$id'";
		return mysqli_query($conexion, $sql);
	}
	public function eliminarPie($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();


		$sql1 = "SELECT Piezas FROM piezasser WHERE ID = $id";
		$query = $conexion->query($sql1);
		$pieza = mysqli_fetch_array($query);
		$sql1 = "SELECT Cantidad FROM piezasser WHERE ID = $id";
		$query = $conexion->query($sql1);
		$cantidad = mysqli_fetch_array($query);
		$sql1 = "SELECT Existencia FROM piezas WHERE ID = $pieza[0]";
		$query = $conexion->query($sql1);
		$exist = mysqli_fetch_array($query);
		$suma = ($cantidad[0] + $exist[0]);
		$sql = "UPDATE piezas set Existencia=$suma where ID='$pieza[0]'";
		mysqli_query($conexion, $sql);

		$sql = "DELETE FROM piezasser where id='$id'";
		return mysqli_query($conexion, $sql);
	}

	public function verificarT($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql1 = "SELECT Estado FROM trabajo WHERE Trabajo = $id";
		$query = $conexion->query($sql1);
		$cos = mysqli_fetch_array($query);
		return $cos[0];
	}

	public function verificarPie($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();

		$sql1 = "SELECT Existencia FROM piezas WHERE ID = $id";
		$query = $conexion->query($sql1);
		$cos = mysqli_fetch_array($query);
		return $cos[0];
	}
	public function activatT($id)
	{
		$obj = new conectar();
		$conexion = $obj->conexion();
		$sql = "UPDATE idtrabajo set Estado='1' where ID='$id'";
		return mysqli_query($conexion, $sql);
	}
}
