<?php 

require_once "Trabajos/Clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();

$sql="SELECT * from idtrabajo WHERE Estado='1'";
$result=mysqli_query($conexion,$sql);
$sql222="SELECT * from color";
$result222=mysqli_query($conexion,$sql222);
$mostrar222 = mysqli_fetch_row($result222);
?>


<div>
	<table class="table table-hover table-condensed table-bordered" id="iddatatable">
		<thead style="background-color: #<?php echo $mostrar222[0]?>;color: white; font-weight: bold;">
			<tr>
				<td>ID</td>
				<td>Cliente</td>
				<td>Cliente</td>
				<td>vehiculo</td>
				<td>vehiculo</td>
				<td>Detalles</td>
				<td>Finalizar</td>
				<td>Cancelar</td>
			</tr>
		</thead>
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>ID</td>
				<td>Cliente</td>
				<td>Cliente</td>
				<td>vehiculo</td>
				<td>vehiculo</td>
				<td>Detalles</td>
				<td>Finalizar</td>
				<td>Cancelar</td>
			</tr>
		</tfoot>
		<tbody >
			<?php 
			while ($mostrar=mysqli_fetch_row($result)) {
				$sql2 = "SELECT Cliente FROM vehiculo WHERE ID = $mostrar[1]";
				$result2 = mysqli_query($conexion, $sql2);
				$mostrar2 = mysqli_fetch_row($result2);
				$sql3 = "SELECT Nombre FROM cliente WHERE ID = $mostrar2[0]";
				$result3 = mysqli_query($conexion, $sql3);
				$mostrar3 = mysqli_fetch_row($result3);
				$sql4 = "SELECT Apellido FROM cliente WHERE ID = $mostrar2[0]";
				$result4 = mysqli_query($conexion, $sql4);
				$mostrar4 = mysqli_fetch_row($result4);

				$sql5 = "SELECT Marca FROM vehiculo WHERE ID = $mostrar[1]";
				$result5 = mysqli_query($conexion, $sql5);
				$mostrar5 = mysqli_fetch_row($result5);
				$sql6 = "SELECT Nombre FROM marca WHERE ID = $mostrar5[0]";
				$result6 = mysqli_query($conexion, $sql6);
				$mostrar6 = mysqli_fetch_row($result6);

				$sql7 = "SELECT Modelo FROM vehiculo WHERE ID = $mostrar[1]";
				$result7 = mysqli_query($conexion, $sql7);
				$mostrar7 = mysqli_fetch_row($result7);
				$sql8 = "SELECT Nombre FROM modelo WHERE ID = $mostrar7[0]";
				$result8 = mysqli_query($conexion, $sql8);
				$mostrar8 = mysqli_fetch_row($result8);
				?>
				<tr >
					<td><?php echo $mostrar[0] ?></td>
					<td><?php echo $mostrar3[0]?></td>
					<td><?php echo $mostrar4[0]?></td>
					<td><?php echo $mostrar6[0]?></td>
					<td><?php echo $mostrar8[0]?></td>
					<td style="text-align: center;">
						<span class="btn btn-info btn-sm" data-toggle="modal"  onclick="piezas('<?php echo $mostrar[0] ?>','Detalles')">
							<span class="fa fa-pencil-square-o"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-success btn-sm" data-toggle="modal"  onclick="Finalizar('<?php echo $mostrar[0] ?>')">
							<span class="fa fa-check"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php echo $mostrar[0] ?>')">
							<span class="fa fa-trash"></span>
						</span>
					</td>
				</tr>
				<?php 
			}
			?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#iddatatable').DataTable();
	} );
</script>