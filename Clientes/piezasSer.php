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
	$idd = $_GET["idd"];
	$tr = $_GET["tr"];
	$idx;
	?>
	<?php
	$sql = "SELECT * FROM piezasser WHERE Trabajo = $tr";
	$result = mysqli_query($conexion, $sql);
	$sql222="SELECT * from color";
	$result222=mysqli_query($conexion,$sql222);
	$mostrar222 = mysqli_fetch_row($result222);
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
										<td>Pieza</td>
										<td>Cantidad</td>
										<td>Costo</td>
										<td>Editar</td>
										<td>Eliminar</td>
									</tr>
								</thead>
								<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
									<tr>
										<td>Pieza</td>
										<td>Cantidad</td>
										<td>Costo</td>
										<td>Editar</td>
										<td>Eliminar</td>
									</tr>
								</tfoot>
								<tbody>
									<?php
									while ($mostrar = mysqli_fetch_row($result)) {
										$sql2 = "SELECT CostoC FROM idpiezas WHERE Pieza = $mostrar[2]";
										$result2 = mysqli_query($conexion, $sql2);
										$mostrar2 = mysqli_fetch_row($result2);
										$costo = ($mostrar2[0] * $mostrar[3]);
										$sql3 = "SELECT Nombre FROM piezas WHERE ID = $mostrar[2]";
										$result3 = mysqli_query($conexion, $sql3);
										$mostrar3 = mysqli_fetch_row($result3);
									?>
										<tr>
											<td><?php echo $mostrar3[0] ?></td>
											<td><?php echo $mostrar[3] ?></td>
											<td><?php echo $costo ?></td>
											<td style="text-align: center;">
												<span class="btn btn-warning btn-sm" data-toggle="modal" onclick="agregarServicios('<?php echo $mostrar[0] ?>')">
													<span class="fa fa-wrench"></span>
												</span>
											</td>
											<td style="text-align: center;">
												<span class="btn btn-danger btn-sm" data-toggle="modal" onclick="eliminarDatos('<?php echo $mostrar[0] ?>')">
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
						<input type="text" hidden="" value="<?php echo $idd; ?>" id="idd" name="idd">
						<label>Piezas:</label>
						<select class="form-control input-lg" id="piezSele" onchange="cambioSeleccion()">
							<?php
							$sql = "SELECT * FROM piezas WHERE Visible=1";
							$query = $conexion->query($sql);
							while ($valores = mysqli_fetch_array($query)) {
								echo "<option value='" . $valores[0] . "'>" . $valores[1] . "</option>";
							}
							?>
						</select>
						<label>Cantidad</label>
						<input type="text" class="form-control input-sm" id="cantidad" name="cantidad" value="0">
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
		var id = localStorage.getItem("iTr");
		var no = localStorage.getItem("nTr");
		var c = localStorage.getItem("nTc");
		location.replace("TrabajosSer.php?n=" + no + "& i=" + id + "& c=" + c);
	}
</script>
<script type="text/javascript">
	$(document).ready(function() {

		$('#btnAgregarnuevo').click(function() {
			const pie = document.getElementById('piezSele');
			const piee = pie.value.trim();
			const cos = document.getElementById('cantidad');
			const coss = cos.value.trim();

			$.ajax({
				type: "POST",
				data: "id=" + piee,
				url: "procesos/verificarPie.php",
				success: function(r) {
					var str = r.replace(/^\s+|\s+$/gm, '');
					if (parseInt(coss) <= parseInt(r)) {
						var i = localStorage.getItem("IDD");
						var n = localStorage.getItem("NMM");
						var id = document.getElementById("id").value;
						var pie = document.getElementById("piezSele").value;
						var can = document.getElementById("cantidad").value;
						var tr = localStorage.getItem("tr");
						var datos = "id=" + tr + "&pie=" + pie + "&can=" + can;
						console.log(datos);
						$.ajax({
							type: "POST",
							data: datos,
							url: "procesos/agregarSP.php",
							success: function(r) {
								console.log(r);
								if (r) {
									$('#frmnuevo')[0].reset();
									const idd = document.getElementById('idd');
									const iddd = idd.value.trim();
									var tr = localStorage.getItem("tr");
									alertify.success("agregado con exito");
									localStorage.setItem("ZZZ", "1");
									location.replace("piezasSer.php?n=Trabajo" + "& i=" + i + "&idd=" + iddd + "&tr=" + tr);
								} else {
									alertify.error("Fallo al agregar");
								}
							}
						});
					} else {
						alertify.error("Cantidad de piezas insuficiente");
						alertify.error("Solicitó:" + parseInt(coss) + "");
						alertify.error("Existentes:" + parseInt(str) + "");
					}
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

	function eliminarDatos(id, c) {
		alertify.confirm('Eliminar Piezas', '¿Seguro que desea Eliminar estas Piezas?', function() {

			$.ajax({
				type: "POST",
				data: "id=" + id,
				url: "procesos/eliminarPie.php",
				success: function(r) {
					console.log(r);
					if (r == 1) {
						var i = localStorage.getItem("IDD");
						var n = localStorage.getItem("NMM");
						localStorage.setItem("ZZZ", "4");
						location.replace("trabajos.php?n=" + n + "& i=" + i + "& car=" + c + "");
					} else {
						alertify.error("No se pudo eliminar...");
					}
				}
			});

		}, function() {

		});
	}

	function Avtivar(id, c) {
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
									var i = localStorage.getItem("IDD");
									var n = localStorage.getItem("NMM");
									localStorage.setItem("ZZZ", "3");
									location.replace("trabajos.php?n=" + n + "& i=" + i + "& car=" + c + "");
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