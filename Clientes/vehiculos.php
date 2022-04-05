<!DOCTYPE html>
<html>

<head>
	<title></title>
	<?php
	require_once "../scripts.php";
	$n = $_GET["n"];
	$i = $_GET["i"];
	$idx;
	?>
	<?php
	require_once "../Conexion/conexion.php";
	$obj = new conectar();
	$conexion = $obj->conexion();
	?>
	<?php
	$sql = "SELECT * FROM vehiculo WHERE Cliente = $i and Estado=1";
	$result = mysqli_query($conexion, $sql);
	$sql222="SELECT * from color";
	$result222=mysqli_query($conexion,$sql222);
	$mostrar222 = mysqli_fetch_row($result222);
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
								<a class="nav-item nav-link" href="../Clientes/clientes.php">Atras</a>
							</div>
						</div>
					</nav>
				</div>
				<div class="card text-left">
					<div class="card-body">
						<h1 id="Nombress"><?php echo $n; ?>
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
										<td>Marca</td>
										<td>Modelo</td>
										<td>Año</td>
										<td>Servicio</td>
										<td>Historial</td>
										<td>Eliminar</td>
									</tr>
								</thead>
								<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
									<tr>
										<td>Marca</td>
										<td>Modelo</td>
										<td>Año</td>
										<td>Servicio</td>
										<td>Historial</td>
										<td>Eliminar</td>
									</tr>
								</tfoot>
								<tbody>
									<?php
									while ($mostrar = mysqli_fetch_row($result)) {
										$sql2 = "SELECT Nombre FROM marca WHERE ID = $mostrar[2] and Visible=1";
										$result2 = mysqli_query($conexion, $sql2);
										$mostrar2 = mysqli_fetch_row($result2);
										$sql3 = "SELECT Nombre FROM modelo WHERE ID = $mostrar[3] and Visible=1";
										$result3 = mysqli_query($conexion, $sql3);
										$mostrar3 = mysqli_fetch_row($result3);
									?>
										<tr>
											<td><?php echo $mostrar2[0] ?></td>
											<td><?php echo $mostrar3[0] ?></td>
											<td><?php echo $mostrar[4] ?></td>
											<td style="text-align: center;">
												<span class="btn btn-info btn-sm" data-toggle="modal" onclick="agregarTrabajo('<?php echo $mostrar[0] ?>','<?php echo $mostrar2[0] ?>','<?php echo $mostrar3[0] ?>')">
													<span class="fa fa-wrench"></span>
												</span>
											</td>
											<td style="text-align: center;">
												<span class="btn btn-success btn-sm" data-toggle="modal" onclick="hist('<?php echo $mostrar[0] ?>','<?php echo $mostrar2[0] ?>','<?php echo $mostrar3[0] ?>')">
													<span class="fa fa-file-text-o"></span>
												</span>
											</td>
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
					<h5 class="modal-title" id="exampleModalLabel">Agrega nueva Vehiculo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
						<input type="text" hidden="" value="<?php echo $i; ?>" id="id" name="id">
						<label>Marcas:</label>
						<select class="form-control input-lg" id="marcaSele" onchange="cambioSeleccion()">
							<?php
							$sql = "SELECT * FROM marca WHERE Visible=1";
							$query = $conexion->query($sql);
							while ($valores = mysqli_fetch_array($query)) {
								echo "<option value='" . $valores[0] . "'>" . $valores[1] . "</option>";
							}
							?>
						</select>
						<script>
							var x = document.getElementById("marcaSele").value;
							$.ajax({
								type: "POST",
								data: "id=" + x,
								url: "procesos/Modelos.php",
								success: function(r) {
									datos = jQuery.parseJSON(r);
									for (let index = 0; index < datos.length; index++) {
										var x = document.getElementById("modeSele");
										var option = document.createElement("option");
										option.text = (datos[index]["nombre"]);
										option.value = (datos[index]["id"]);
										x.add(option);
									}
								}
							});

							function cambioSeleccion() {
								document.getElementById('modeSele').options.length = 0;
								var x = document.getElementById("marcaSele").value;
								$.ajax({
									type: "POST",
									data: "id=" + x,
									url: "procesos/Modelos.php",
									success: function(r) {
										datos = jQuery.parseJSON(r);
										for (let index = 0; index < datos.length; index++) {
											var x = document.getElementById("modeSele");
											var option = document.createElement("option");
											option.text = (datos[index]["nombre"]);
											option.value = (datos[index]["id"]);
											x.add(option);
										}
									}
								});
							}
						</script>
						<label>Modelo:</label>
						<select class="form-control input-lg" id="modeSele">
						</select>
						<label>Año:</label>
						<input type="text" class="form-control input-sm" id="año" name="año" value="0" onfocus="consejoA()" onfocusout="validarAño()">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btnAgregarnuevo" class="btn btn-primary">Agregar nuevo</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		function consejoA() {
			alertify.message('Un año valido debe estar dentro del rango 1984 - 2100');
		}
		function validarAño() {
			const año = document.getElementById('año');
			const añoo = año.value.trim();

			if (añoo === '') {
				document.getElementById("año").classList.remove('Correcto');
				document.getElementById("año").classList.add('Error');
				alertify.error('campo "Año" vacio'); 
			} else if (añoo.length != 4) {
				document.getElementById("año").classList.remove('Correcto');
				document.getElementById("año").classList.add('Error'); 
				alertify.error('Año invalido'); 
			} else if (añoo > 2100 || añoo <= 1984) {
				document.getElementById("año").classList.remove('Correcto');
				document.getElementById("año").classList.add('Error');
				alertify.error('Año invalido'); 
			} else if (soloLetras(añoo)) {
				document.getElementById("año").classList.remove('Correcto');
				document.getElementById("año").classList.add('Error');
				alertify.error('Formato de Año incorrecto - YYYY'); 
			} else {
				document.getElementById("año").classList.remove('Error');
				document.getElementById("año").classList.add('Correcto');
			}
		}
		function validarAñoU() {
			const año = document.getElementById('añoU');
			const añoo = año.value.trim();

			if (añoo === '') {
				document.getElementById("añoU").classList.remove('Correcto');
				document.getElementById("añoU").classList.add('Error');
				alertify.error('campo "Año" vacio'); 
			} else if (añoo.length != 4) {
				document.getElementById("añoU").classList.remove('Correcto');
				document.getElementById("añoU").classList.add('Error'); 
				alertify.error('Año invalido'); 
			} else if (añoo > 2100 || añoo <= 1984) {
				document.getElementById("añoU").classList.remove('Correcto');
				document.getElementById("añoU").classList.add('Error');
				alertify.error('Año invalido'); 
			} else if (soloLetras(añoo)) {
				document.getElementById("añoU").classList.remove('Correcto');
				document.getElementById("añoU").classList.add('Error');
				alertify.error('Formato de Año incorrecto - YYYY'); 
			} else {
				document.getElementById("añoU").classList.remove('Error');
				document.getElementById("añoU").classList.add('Correcto');
			}
		}

	</script>

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
		alertify.success("Eliminado con exito !");
	}
	if (z == 4) {
		alertify.success("Finalizado con exito !");
	}
	localStorage.setItem("ZZZ", "0");
</script>
<script>
	var z = localStorage.getItem("ZZZ");
	if (z == 1) {
		alertify.success("agregado con exito");
	}
	localStorage.setItem("ZZZ", "0");
</script>
<script type="text/php">
</script>
<script type="text/javascript">
	function agregarTrabajo(id, marca, modelo) {
		$(document).ready(function() {
			var nom = localStorage.getItem("NMM");
			localStorage.setItem("IDD", id);
			localStorage.setItem("NMM", nom);
			localStorage.setItem("ZZZ", "0");
			localStorage.setItem("iT", id);
			localStorage.setItem("nT", (nom + " - " + marca + " " + modelo));
			location.replace("trabajos.php?n=" + (nom + " - " + marca + " " + modelo) + "& i=" + id);
		});
	}

	function hist(id, marca, modelo) {
		$(document).ready(function() {
			var nom = localStorage.getItem("NMM");
			localStorage.setItem("IDD", id);
			localStorage.setItem("NMM", (nom + " - " + marca + " " + modelo));
			localStorage.setItem("ZZZ", "0");
			localStorage.setItem("iT", id);
			localStorage.setItem("nT", (nom + " - " + marca + " " + modelo));
			location.replace("trabajosHis.php?n=" + (nom + " - " + marca + " " + modelo) + "& i=" + id);
		});
	}

	$(document).ready(function() {
		$('#btnAgregarnuevo').click(function() {
			var band = "1";
			const año = document.getElementById('año');
			const añoo = año.value.trim();

			if (añoo === '') {
				document.getElementById("año").classList.remove('Correcto');
				document.getElementById("año").classList.add('Error');
				alertify.error('campo "Año" vacio'); 
				band = "0";
			} else if (añoo.length != 4) {
				document.getElementById("año").classList.remove('Correcto');
				document.getElementById("año").classList.add('Error'); 
				alertify.error('Año invalido'); 
				band = "0";
			} else if (añoo > 2100 || añoo <= 1984) {
				document.getElementById("año").classList.remove('Correcto');
				document.getElementById("año").classList.add('Error');
				alertify.error('Año invalido'); 
				band = "0";
			} else if (soloLetras(añoo)) {
				document.getElementById("año").classList.remove('Correcto');
				document.getElementById("año").classList.add('Error');
				alertify.error('Formato de Año incorrecto - YYYY'); 
				band = "0";
			} else {
				document.getElementById("año").classList.remove('Error');
				document.getElementById("año").classList.add('Correcto');
			}

			try {
				var xx = document.getElementById("marcaSele").value;
				var yy = document.getElementById("modeSele").value;
			} catch (error) {}
			if (xx === '') {
				band = "0";
			}
			if (yy === '') {
				band = "0";
			}
			if (band === "1") {
				var cli = document.getElementById("id").value;
				var mar = document.getElementById("marcaSele").value;
				var mood = document.getElementById("modeSele").value;
				var datos = "cliente=" + cli + "&marca=" + mar + "&modelo=" + mood + "&año=" + añoo;
				$.ajax({
					type: "POST",
					data: datos,
					url: "procesos/agregarV.php",
					success: function(r) {
						console.log(r);
						datos = jQuery.parseJSON(r);
						if (r == 1) {
							$('#frmnuevo')[0].reset();
							var i = localStorage.getItem("iV");
							var n = localStorage.getItem("nV");
							localStorage.setItem("ZZZ", "1");
							location.replace("vehiculos.php?n=" + n + "& i=" + i + "");
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
			url: "procesos/obtenDatos.php",
			success: function(r) {
				datos = jQuery.parseJSON(r);
				$('#id').val(datos['id']);
				$('#nombreU').val(datos['nombre']);
			}
		});
	}

	function eliminarDatos(id) {
		alertify.confirm('Eliminar Vehiculo', '¿Seguro que desea eliminar este Vehiculo?', function() {

			$.ajax({
				type: "POST",
				data: "id=" + id,
				url: "procesos/eliminarV.php",
				success: function(r) {
					if (r == 1) {
						var i = localStorage.getItem("iV");
						var n = localStorage.getItem("nV");
						localStorage.setItem("ZZZ", "3");
						location.replace("vehiculos.php?n=" + n + "& i=" + i + "");
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