<!DOCTYPE html>
<html>

<head>
	<title></title>

	<?php
	require_once "../Conexion/conexion.php";
	$obj = new conectar();
	$conexion = $obj->conexion();
	?>
	<?php
	require_once "../scripts.php";
	$n = $_GET["n"];
	$i = $_GET["i"];
	$idx;
	$sql222="SELECT * from color";
	$result222=mysqli_query($conexion,$sql222);
	$mostrar222 = mysqli_fetch_row($result222);
	?>
	<?php
	$sql = "SELECT * FROM idtrabajo WHERE Vehiculo = $i and Estado=2";
	$result = mysqli_query($conexion, $sql);
	?>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card-header">
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<a class="navbar-brand">Menu</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
							<div class="navbar-nav">
								<a class="nav-item nav-link" onclick=atrasV()>Atras</a>
							</div>
						</div>
					</nav>
				</div>
				<div class="card text-left">
					<div class="card-body">
						<h1><?php echo $n; ?>
						</h1>
					</div>
					<div class="card-body">
						<span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">Agregar nuevo <span class="fa fa-plus-circle"></span>
						</span>
						<hr>
						<div>
							<table class="table table-hover table-condensed table-bordered" id="iddatatableM">
								<thead style="background-color: #<?php echo $mostrar222[0]?>;color: white; font-weight: bold;">
									<tr>
										<td>ID</td>
										<td>Fecha</td>
										<td>Servicios</td>
										<td>Activar</td>
										<td>Cancelar</td>
									</tr>
								</thead>
								<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
									<tr>
										<td>ID</td>
										<td>Fecha</td>
										<td>Servicios</td>
										<td>Activar</td>
										<td>Cancelar</td>
									</tr>
								</tfoot>
								<tbody>
									<?php
									while ($mostrar = mysqli_fetch_row($result)) {
									?>
										<tr>
											<td><?php echo $mostrar[0] ?></td>
											<td><?php echo $mostrar[2] ?></td>
											<td style="text-align: center;">
												<span class="btn btn-info btn-sm" data-toggle="modal" onclick="agregarServicios('<?php echo $mostrar[0] ?>','<?php echo $i ?>')">
													<span class="fa fa-wrench"></span>
												</span>
											</td>
											<td style="text-align: center;">
												<span class="btn btn-success btn-sm" onclick="Avtivar('<?php echo $mostrar[0] ?>')">
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
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Agrega nuevo Trabajo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
						<input type="text" hidden="" value="<?php echo $i; ?>" id="id" name="id">
						<label>Desea agregar un nuevo Trabajo?</label>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btnAgregarnuevo" class="btn btn-primary">Agregar nuevo</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar Marca</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevoU">
						<input type="text" hidden="" id="id" name="id">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-warning" id="btnActualizar">Actualizar</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>

<script>
	var z = localStorage.getItem("ZZZ");
	if (z == 1) {
		alertify.success("agregado con exito");
	}
	if (z == 2) {
		alertify.success("Actualizado con exito");
	}
	if (z == 3) {
		alertify.success("Activado con exito !");
	}
	if (z == 4) {
		alertify.success("Cancelado con exito !");
	}
	localStorage.setItem("ZZZ", "0");
</script>
<script type="text/php">
</script>
<script>
	function atrasV() {
		localStorage.setItem("ZZZ", "0");
		var id = localStorage.getItem("iV");
		var no = localStorage.getItem("nV");
		location.replace("vehiculos.php?n=" + no + "& i=" + id);
	}
</script>
<script type="text/javascript">
	function agregarServicios(id, c) {
		$(document).ready(function() {
			localStorage.setItem("IDD", id);
			localStorage.setItem("ZZZ", "0");
			localStorage.setItem("iTr", id);
			localStorage.setItem("nTr", "Trabajo");
			localStorage.setItem("nTc", c);
			location.replace("trabajosSer.php?n=Trabajo& i=" + id + "& c=" + c);
		});
	}

	$(document).ready(function() {
		$('#btnAgregarnuevo').click(function() {
			localStorage.setItem("ZZZ", "1");
			var i = localStorage.getItem("iT");
			var n = localStorage.getItem("nT");
			var id = document.getElementById("id").value;
			var datos = "id=" + id;
			$.ajax({
				type: "POST",
				data: datos,
				url: "procesos/agregarT.php",
				success: function(r) {
					console.log(r);
					if (r) {
						$('#frmnuevo')[0].reset();
						alertify.success("agregado con exito");
						location.replace("trabajos.php?n=" + n + "& i=" + i + "");
					} else {
						alertify.error("Fallo al agregar");
					}
				}
			});
		});

		$('#btnActualizar').click(function() {
			datos = $('#frmnuevoU').serialize();

			$.ajax({
				type: "POST",
				data: datos,
				url: "procesos/actualizar.php",
				success: function(r) {
					if (r == 1) {
						$('#tablaDatatable').load('tablaM.php');
						alertify.success("Actualizado con exito");
					} else {
						alertify.error("Fallo al actualizar");
					}
				}
			});
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaDatatable').load('tablaM.php');
	});
</script>

<script type="text/javascript">
	function agregaFrmActualizar(id) {
		$.ajax({
			type: "POST",
			data: "id=" + id,
			url: "procesos/obtenDatos.php",
			success: function(r) {
				datos = jQuery.parseJSON(r);
				$('#id').val(datos['id']);
				$('#nombreU').val(datos['nombre']);
			}
		});
	}

	function eliminarDatos(id) {
		alertify.confirm('Cancelar Trabajo', '¿Seguro que desea cancelar este Trabajo?', function() {
			$.ajax({
				type: "POST",
				data: "id=" + id,
				url: "procesos/eliminarT.php",
				success: function(r) {
					console.log(r);
					if (r == 1) {
						var i = localStorage.getItem("iT");
						var n = localStorage.getItem("nT");
						localStorage.setItem("ZZZ", "4");
						location.replace("trabajos.php?n=" + n + "& i=" + i + "& car=");
					} else {
						alertify.error("No se pudo eliminar...");
					}
				}
			});

		}, function() {

		});
	}

	function Avtivar(id) {
		alertify.confirm('Activar Trabajo', '¿Seguro que desea Activar este Trabajo?', function() {
			var band = 0;
			$.ajax({
				type: "POST",
				data: "id=" + id,
				url: "procesos/verificarT.php",
				success: function(r) {
					if (r == 2) {
						$.ajax({
							type: "POST",
							data: "id=" + id,
							url: "procesos/avtivarT.php",
							success: function(r) {
								console.log(r);
								if (r == 1) {
									var i = localStorage.getItem("iT");
									var n = localStorage.getItem("nT");
									localStorage.setItem("ZZZ", "3");
									location.replace("trabajos.php?n=" + n + "& i=" + i + "");
								} else {
									alertify.error("No se pudo eliminar...");
								}
							}
						});
					} else {}
				}
			});
		}, function() {});
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#iddatatableM').dataTable({
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible en esta tabla",
				"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix": "",
				"sSearch": "Buscar:",
				"sUrl": "",
				"sInfoThousands": ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				},
				"buttons": {
					"copy": "Copiar",
					"colvis": "Visibilidad"
				}
			}
		});
	});
</script>