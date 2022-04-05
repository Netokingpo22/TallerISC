<?php

require_once "../Conexion/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

$sql = "SELECT * from piezas WHERE Visible='1'";
$result = mysqli_query($conexion, $sql);
$sql222="SELECT * from color";
$result222=mysqli_query($conexion,$sql222);
$mostrar222 = mysqli_fetch_row($result222);
?>


<div>
	<table class="table table-hover table-condensed table-bordered" id="iddatatable">
		<thead style="background-color: #<?php echo $mostrar222[0]?>;color: white; font-weight: bold;" id="Enca">
		<script>
			document.getElementById("Enca").classList.remove('Correcto');
		</script>
			<tr>
				<td>Configuración</td>
				<td>Opción</td>
			</tr>
		</thead>
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>Configuración</td>
				<td>Opción </td>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td>Respaldar</td>
				<td style="text-align: center;">
					<span class="btn btn-primary btn-sm" onclick="agregaFrmActualizarZ()">
						<span class="fa fa-pencil-square-o"></span>
					</span>
				</td>
			</tr>
			<tr>
				<td>Restaurar</td>
				<td style="text-align: center;">
					<span class="btn btn-success btn-sm" onclick="agregaFrmActualizar()">
						<span class="fa fa-pencil-square-o"></span>
					</span>
				</td>
			</tr>
			<tr>
				<td>Colores</td>
				<td style="text-align: center;">
					<span class="btn btn-danger btn-sm" onclick="agregarVehiculoxxx()">
						<span class="fa fa-pencil-square-o"></span>
					</span>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#iddatatable').DataTable();
	});
</script>