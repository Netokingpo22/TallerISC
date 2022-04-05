<!DOCTYPE html>
<html>

<head>
	<title></title>
	<?php
	require_once "../scripts.php";
	$n = $_GET["n"];
	$i = $_GET["i"];
	?>
	<?php
	require_once "../Conexion/conexion.php";
	$obj = new conectar();
	$conexion = $obj->conexion();
	?>
	<?php
	$sql = "SELECT * FROM trabajo WHERE Trabajo = $i and Estado=2";
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
								<a class="nav-item nav-link" href="../Inicio.php">Atras</a>
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
						<hr>
						<div>
							<table class="table table-hover table-condensed table-bordered" id="iddatatableM">
								<thead style="background-color: #dc3545;color: white; font-weight: bold;">
									<tr>
										<td>Servicio</td>
										<td>Costo</td>
										<td>Piezas</td>
									</tr>
								</thead>
								<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
									<tr>
										<td>Servicio</td>
										<td>Costo</td>
										<td>Piezas</td>
									</tr>
								</tfoot>
								<tbody>
									<?php
									while ($mostrar = mysqli_fetch_row($result)) {
										$sql3 = "SELECT Nombre FROM servicio WHERE ID = $mostrar[2] and Visible=1";
										$result3 = mysqli_query($conexion, $sql3);
										$mostrar3 = mysqli_fetch_row($result3);
										$sql4 = "SELECT Nombre FROM piezas WHERE ID = $mostrar[4] and Visible BETWEEN 1 and 2";
										$result4 = mysqli_query($conexion, $sql4);
										$mostrar4 = mysqli_fetch_row($result4);
									?>
										<tr>
											<td><?php echo $mostrar3[0] ?></td>
											<td><?php echo $mostrar[4] ?></td>
											<td style="text-align: center;">
												<span class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizar('<?php echo $mostrar[0] ?>')">
													<span class="fa fa-pencil-square-o"></span>
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
					<h5 class="modal-title" id="exampleModalLabel">Agrega nuevo Pedido</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
						<input type="text" hidden="" value="<?php echo $i; ?>" id="id" name="id">
						<label>Marcas:</label>
						<select class="form-control input-lg" id="piezSele" onchange="cambioSeleccion()">
							<?php
							$sql = "SELECT * FROM piezas WHERE Proveedor=$i and Visible=1";
							$query = $conexion->query($sql);
							while ($valores = mysqli_fetch_array($query)) {
								echo "<option value='" . $valores[0] . "'>" . $valores[1] . "</option>";
							}
							?>
						</select>
						<label>Cantidad</label>
						<input type="text" class="form-control input-sm" id="cantidad" name="cantidad">
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
					<h5 class="modal-title" id="exampleModalLabel">Actualizar Pedido</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevoU">
						<input type="text" hidden="" id="idU" name="idU">
						<label>Cantidad</label>
						<input type="text" class="form-control input-sm" id="cantidadU" name="cantidadU">
						<label>Costo</label>
						<input type="text" class="form-control input-sm" id="costoU" name="costoU">
					</form>
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
		alertify.success("Cancelado con exito !");
	}
	if (z == 4) {
		alertify.success("Finalizado con exito !");
	}
	localStorage.setItem("ZZZ", "0");
</script>
<script type="text/php">
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#btnAgregarnuevo').click(function() {
			var band = "1";
			var caa = document.getElementById("cantidad").value;
			try {
				var xx = document.getElementById("piezSele").value;
			} catch (error) {}
			if (xx === '') {
				document.getElementById("cantidad").classList.remove('Correcto');
				document.getElementById("cantidad").classList.add('Error');
				band = "0";
			}

			if (caa === '') {
				document.getElementById("cantidad").classList.remove('Correcto');
				document.getElementById("cantidad").classList.add('Error');
				band = "0";
			} else if (caa < 0) {
				document.getElementById("cantidad").classList.remove('Correcto');
				document.getElementById("cantidad").classList.add('Error');
				band = "0";
			} else if (soloLetras(caa)) {
				document.getElementById("cantidad").classList.remove('Correcto');
				document.getElementById("cantidad").classList.add('Error');
				band = "0";
			} else {
				document.getElementById("cantidad").classList.remove('Error');
				document.getElementById("cantidad").classList.add('Correcto');
			}

			if (band === "1") {
				document.getElementById("cantidad").classList.remove('Error');
				document.getElementById("cantidad").classList.remove('Correcto');
				document.getElementById("cantidad").classList.remove('Normal');

				var i = localStorage.getItem("IDD");
				var n = localStorage.getItem("NMM");
				var id = document.getElementById("id").value;
				var pie = document.getElementById("piezSele").value;
				var ca = document.getElementById("cantidad").value;
				var datos = "id=" + id + "&pie=" + pie + "&can=" + ca;
				$.ajax({
					type: "POST",
					data: datos,
					url: "procesos/agregarPe.php",
					success: function(r) {
						if (r == 1) {
							$('#frmnuevo')[0].reset();
							$('#tablaDatatable').load('tablaM.php');
							alertify.success("agregado con exito");
							localStorage.setItem("ZZZ", "1");
							location.replace("pedidos.php?n=" + n + "& i=" + i + "");
						} else {
							alertify.error("Fallo al agregar");
						}
					}
				});
			}
		});

		$('#btnActualizar').click(function() {
			var caa = document.getElementById("cantidadU").value;
			var cos = document.getElementById("costoU").value;
			var band = "1";

			if (caa === '') {
				document.getElementById("cantidadU").classList.remove('Correcto');
				document.getElementById("cantidadU").classList.add('Error');
				band = "0";
			} else if (caa < 0) {
				document.getElementById("cantidadU").classList.remove('Correcto');
				document.getElementById("cantidadU").classList.add('Error');
				band = "0";
			} else if (soloLetras(caa)) {
				document.getElementById("cantidadU").classList.remove('Correcto');
				document.getElementById("cantidadU").classList.add('Error');
				band = "0";
			} else {
				document.getElementById("cantidadU").classList.remove('Error');
				document.getElementById("cantidadU").classList.add('Correcto');
			}

			if (cos === '') {
				document.getElementById("costoU").classList.remove('Correcto');
				document.getElementById("costoU").classList.add('Error');
				band = "0";
			} else if (cos < 0) {
				document.getElementById("costoU").classList.remove('Correcto');
				document.getElementById("costoU").classList.add('Error');
				band = "0";
			} else if (soloLetras(cos)) {
				document.getElementById("costoU").classList.remove('Correcto');
				document.getElementById("costoU").classList.add('Error');
				band = "0";
			} else {
				document.getElementById("costoU").classList.remove('Error');
				document.getElementById("costoU").classList.add('Correcto');
			}

			if (band === "1") {
				document.getElementById("cantidadU").classList.remove('Error');
				document.getElementById("cantidadU").classList.remove('Correcto');
				document.getElementById("cantidadU").classList.remove('Normal');
				document.getElementById("costoU").classList.remove('Error');
				document.getElementById("costoU").classList.remove('Correcto');
				document.getElementById("costoU").classList.remove('Normal');
				datos = $('#frmnuevoU').serialize();

				var i = localStorage.getItem("IDD");
				var n = localStorage.getItem("NMM");
				$.ajax({
					type: "POST",
					data: datos,
					url: "procesos/actualizarPe.php",
					success: function(r) {
						if (r == 1) {
							$('#tablaDatatable').load('tablaM.php');
							localStorage.setItem("ZZZ", "2");
							location.replace("pedidos.php?n=" + n + "& i=" + i + "");
							alertify.success("Actualizado con exito");
						} else {
							alertify.error("Fallo al actualizar");
						}
					}
				});
			}
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaDatatable').load('tablaM.php');
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaDatatable').load('tablaM.php');
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaDatatable').load('tabla.php');
	});

	function isEmail(email) {
		return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
	}

	function soloLetras(x) {
		return /^[a-zA-Z]*$/.test(x);
	}
</script>
<script type="text/javascript">
	function agregaFrmActualizar(id) {
		$.ajax({
			type: "POST",
			data: "id=" + id,
			url: "procesos/obtenDatosPe.php",
			success: function(r) {
				datos = jQuery.parseJSON(r);
				$('#idU').val(datos['id']);
				$('#cantidadU').val(datos['pieza']);
				$('#costoU').val(datos['cantidad']);
			}
		});
	}

	function finalizar(id) {
		alertify.confirm('Finalizar Pedido', '¿Seguro que desea finalizar este Pedido?', function() {

			$.ajax({
				type: "POST",
				data: "id=" + id,
				url: "procesos/finalizar.php",
				success: function(r) {
					console.log(r);
					if (r == 1) {
						var i = localStorage.getItem("IDD");
						var n = localStorage.getItem("NMM");
						localStorage.setItem("ZZZ", "4");
						location.replace("pedidos.php?n=" + n + "& i=" + i + "");
					} else {
						alertify.error("No se pudo Cancelar...");
					}
				}
			});

		}, function() {

		});
	}

	function eliminarDatos(id) {
		alertify.confirm('Cancelar Pedido', '¿Seguro que desea cancelar este Pedido?', function() {

			$.ajax({
				type: "POST",
				data: "id=" + id,
				url: "procesos/eliminarPe.php",
				success: function(r) {
					if (r == 1) {
						$('#tablaDatatable').load('tablaM.php');
						var i = localStorage.getItem("IDD");
						var n = localStorage.getItem("NMM");
						localStorage.setItem("ZZZ", "3");
						location.replace("pedidos.php?n=" + n + "& i=" + i + "");
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