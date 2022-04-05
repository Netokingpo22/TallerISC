<?php 

require_once "../Conexion/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();

$sql="SELECT * from proveedor WHERE Visible='1'";
$result=mysqli_query($conexion,$sql);
$sql222="SELECT * from color";
$result222=mysqli_query($conexion,$sql222);
$mostrar222 = mysqli_fetch_row($result222);
?>


<div>
	<table class="table table-hover table-condensed table-bordered" id="iddatatable">
		<thead style="background-color: #<?php echo $mostrar222[0]?>;color: white; font-weight: bold;">
			<tr>
				<td>Empresa</td>
				<td>Celular</td>
				<td>Piezas</td>
				<td>Pedido</td>
			</tr>
		</thead>
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>Empresa</td>
				<td>Celular</td>
				<td>Piezas</td>
				<td>Pedido</td>
			</tr>
		</tfoot>
		<tbody >
			<?php 
			while ($mostrar=mysqli_fetch_row($result)) {
				?>
				<tr >
					<td><?php echo $mostrar[1] ?></td>
					<td><?php echo $mostrar[4] ?></td>
					<td style="text-align: center;">
						<span class="btn btn-info btn-sm" data-toggle="modal"  onclick="piezas('<?php echo $mostrar[0] ?>','<?php echo $mostrar[1] ?>')">
							<span class="fa fa-wrench"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-success btn-sm" data-toggle="modal"  onclick="pedidos('<?php echo $mostrar[0] ?>','<?php echo $mostrar[1] ?>')">
							<span class="fa fa-truck"></span>
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