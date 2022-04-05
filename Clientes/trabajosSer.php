<!DOCTYPE html>
<html>

<head>
	<title></title>
	<?php
	require_once "../scripts.php";
	$n = $_GET["n"];
	$i = $_GET["i"];
	$c = $_GET["c"];
	$idx;
	?>
	<?php
	require_once "../Conexion/conexion.php";
	$obj = new conectar();
	$conexion = $obj->conexion();
	$sql222="SELECT * from color";
	$result222=mysqli_query($conexion,$sql222);
	$mostrar222 = mysqli_fetch_row($result222);
	?>
	<?php
	$sql = "SELECT * FROM trabajo WHERE Trabajo = $i and Estado =2";
	$result = mysqli_query($conexion, $sql);
	?>
</head>

<style type="text/css">
	.Error {
		border-style: solid;
		border-color: coral;
	}

	.Normal {
		border-style: solid;
		border-color: rgb(217, 217, 217);
	}

	.Correcto {
		border-style: solid;
		border-color: rgb(144, 238, 144);
	}
</style>

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
										<td>Servicio</td>
										<td>Costo</td>
										<td>Piezas</td>
										<td>Elimanr</td>
									</tr>
								</thead>
								<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
									<tr>
										<td>Servicio</td>
										<td>Costo</td>
										<td>Piezas</td>
										<td>Elimanr</td>
									</tr>
								</tfoot>
								<tbody>
									<?php
									while ($mostrar = mysqli_fetch_row($result)) {
										$sql2 = "SELECT Nombre FROM servicio WHERE ID = $mostrar[2]";
										$result2 = mysqli_query($conexion, $sql2);
										$mostrar2 = mysqli_fetch_row($result2);
										$sql3 = "SELECT Nombre FROM piezas WHERE ID = $mostrar[4]";
										$result3 = mysqli_query($conexion, $sql3);
										$mostrar3 = mysqli_fetch_row($result3);
									?>
										<tr>
											<td><?php echo $mostrar2[0] ?></td>
											<td><?php echo $mostrar[4] ?></td>
											<td style="text-align: center;">
												<span class="btn btn-success btn-sm" onclick="agregarPieza('<?php echo $mostrar[0]  ?>','<?php echo $i  ?>','<?php echo $n ?>','<?php echo $c ?>')">
													<span class="fa fa-wrench"></span>
												</span>
											</td>
											<td style="text-align: center;">
												<span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php echo $mostrar[0] ?>','<?php echo $c ?>')">
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
					<h5 class="modal-title" id="exampleModalLabel">Agrega nueva Servicio</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
						<input type="text" hidden="" value="<?php echo $i; ?>" id="id" name="id">
						<label>Servicio:</label>
						<select class="form-control input-lg" id="servSele">
							<?php
							$sql = "SELECT * FROM servicio WHERE Visible=1";
							$query = $conexion->query($sql);
							while ($valores = mysqli_fetch_array($query)) {
								echo "<option value='" . $valores[0] . "'>" . $valores[1] . "</option>";
							}
							?>
						</select>
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
						<input type="text" hidden="" id="ids" name="ids" value=<?php echo $c ?>>
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
		alertify.success("Eliminado con exito !");
	}
	localStorage.setItem("ZZZ", "0");
</script>
<script type="text/php">
</script>
<script type="text/javascript">
	function atrasV() {
		localStorage.setItem("ZZZ", "0");
		var id = localStorage.getItem("iT");
		var no = localStorage.getItem("nT");
		location.replace("trabajos.php?n=" + no + "& i=" + id);
	}

	function agregarServicios(id, c) {
		$(document).ready(function() {
			var nom = localStorage.getItem("NMM");
			localStorage.setItem("IDD", id);
			localStorage.setItem("NMM", marca);
			localStorage.setItem("ZZZ", "0");
			location.replace("trabajosSer.php?n=" + (nom) + "& i=" + id + "& c=" + c);
		});
	}

	function agregarPieza(tr, id, c) {
		$(document).ready(function() {
			var nom = localStorage.getItem("NMM");
			localStorage.setItem("tr", tr);
			localStorage.setItem("IDD", id);
			localStorage.setItem("ZZZ", "0");
			var idv = localStorage.getItem("iT");
			location.replace("piezasSer.php?n=Piezas& i=" + id + "& idd=" + idv + "&tr=" + tr);
		});
	}

	$(document).ready(function() {
		$('#btnAgregarnuevo').click(function() {
			var band = "1";

			if (band === "1") {
				var ids = document.getElementById("ids").value;
				var id = document.getElementById("id").value;
				var ser = document.getElementById("servSele").value;
				var datos = "id=" + id + "&ser=" + ser + "&veh=" + ids;

				$.ajax({
					type: "POST",
					data: datos,
					url: "procesos/agregarTS.php",
					success: function(r) {
						console.log(r);
						if (r) {
							$('#frmnuevo')[0].reset();
							var i = localStorage.getItem("IDD");
							var ids = document.getElementById("ids").value;
							localStorage.setItem("ZZZ", "1");
							location.replace("trabajosSer.php?n=Trabajo" + "& i=" + i + "& c=" + ids);
						} else {
							alertify.error("Fallo al agregar");
						}
					}
				});
			}
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

	function eliminarDatos(id, can) {
		alertify.confirm('Eliminar Servicio', '¿Seguro que desea eliminar este Servicio?', function() {

			$.ajax({
				type: "POST",
				data: "id=" + id,
				url: "procesos/eliminarTs.php",
				success: function(r) {
					console.log(r);
					
										if (r == 1) {
											var i = localStorage.getItem("IDD");
											var n = localStorage.getItem("NMM");
											localStorage.setItem("ZZZ", "4");
											location.replace("trabajosSer.php?n=Trabajo" + "& i=" + i + "& c=" + can);
										} else {
											alertify.error("No se pudo eliminar...");
										}
				}
			});

		}, function() {

		});
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