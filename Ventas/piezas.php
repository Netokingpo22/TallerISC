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
	$sql222="SELECT * from color";
	$result222=mysqli_query($conexion,$sql222);
	$mostrar222 = mysqli_fetch_row($result222);
	?>
	<?php
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
								<a class="nav-item nav-link" href="../Ventas/Ventas.php">Atras</a>
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
										<td>Nombre</td>
										<td>Costo-Cliente</td>
										<td>Costo-Proveedor</td>
										<td>Editar</td>
										<td>Eliminar</td>
									</tr>
								</thead>
								<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
									<tr>
										<td>Nombre</td>
										<td>Costo-Cliente</td>
										<td>Costo-Proveedor</td>
										<td>Editar</td>
										<td>Eliminar</td>
									</tr>
								</tfoot>
								<tbody>
									<?php
									$sql1 = "SELECT Pieza FROM idpiezas WHERE Proveedor = $i";
									$query = $conexion->query($sql1);
									while ($cos = mysqli_fetch_row($query)) {
										if ($cos === NULL) {
											$cos[0] = 0;
										}
										$sql = "SELECT * FROM piezas WHERE ID='$cos[0]' and Visible=1";
										$result = mysqli_query($conexion, $sql);
										while ($mostrar = mysqli_fetch_row($result)) {
											$sql2 = "SELECT CostoC FROM idpiezas WHERE Proveedor = $i and Pieza=$cos[0]";
											$query2 = $conexion->query($sql2);
											$mostrar2 = mysqli_fetch_array($query2);
											$sql3 = "SELECT CostoP FROM idpiezas WHERE Proveedor = $i and Pieza=$cos[0]";
											$query3 = $conexion->query($sql3);
											$mostrar3 = mysqli_fetch_array($query3);
									?>
											<tr>
												<td><?php echo $mostrar[1] ?></td>
												<td><?php echo $mostrar2[0] ?></td>
												<td><?php echo $mostrar3[0] ?></td>
												<td style="text-align: center;">
													<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizar('<?php echo $mostrar[0] ?>')">
														<span class="fa fa-pencil-square-o"></span>
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
					<h5 class="modal-title" id="exampleModalLabel">Agrega nueva Pieza</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
						<input type="text" id="id" name="id" value=<?php echo $i ?> hidden="">
						<select class="form-control input-lg" id="piezaSele" onchange="cambioSeleccion()">
							<?php
							$sql = "SELECT * FROM piezas WHERE Visible=1";
							$query = $conexion->query($sql);
							while ($valores = mysqli_fetch_array($query)) {
								$sql4 = "SELECT Pieza FROM idpiezas WHERE Proveedor = $i";
								$query4 = $conexion->query($sql4);
								$mostrar4 = mysqli_fetch_array($query4);
								if ($mostrar4[0] == $valores[0]) {
								}else{
									echo "<option value='" . $valores[0] . "'>" . $valores[1] . "</option>";
								}
							}
							?>
						</select>
						<label>Costo Cliente</label>
						<input type="text" class="form-control input-sm" id="costoc" name="costoc" value="0" onfocus="consejoCC()" onfocusout="validarCostoC()">
						<label>Costo Proveedor</label>
						<input type="text" class="form-control input-sm" id="costop" name="costop" value="0" onfocus="consejoCP()" onfocusout="validarCostoCP()">
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
		function consejoCC() {
			alertify.message('El costo cliente debe ser igual o mayor a 0');
		}
		function consejoCP() {
			alertify.message('El costo proveedor debe ser igual o mayor a 0');
		}

	function validarCostoC() {
		const coc = document.getElementById('costoc');
		const cocc = coc.value.trim();
		if (cocc === '') {
			document.getElementById("costoc").classList.remove('Correcto');
			document.getElementById("costoc").classList.add('Error');
			alertify.error('Campo "Costo Cliente" vacio'); 
			band = "0";
		} else if (cocc < 0) {
			document.getElementById("costoc").classList.remove('Correcto');
			document.getElementById("costoc").classList.add('Error');
			alertify.error('Costo Cliente menor a 0'); 
			band = "0";
		} else if (soloLetras(cocc)) {
			document.getElementById("costoc").classList.remove('Correcto');
			document.getElementById("costoc").classList.add('Error');
			alertify.error('Costo Cliente inválido'); 
			band = "0";
		} else {
			document.getElementById("costoc").classList.remove('Error');
			document.getElementById("costoc").classList.add('Correcto');
		}
	}

	function validarCostoCP() {
		const coc = document.getElementById('costop');
		const cocc = coc.value.trim();
		if (cocc === '') {
			document.getElementById("costop").classList.remove('Correcto');
			document.getElementById("costop").classList.add('Error');
			alertify.error('Campo "Costo Proveedor" vacio'); 
			band = "0";
		} else if (cocc < 0) {
			document.getElementById("costop").classList.remove('Correcto');
			document.getElementById("costop").classList.add('Error');
			alertify.error('Costo Proveedor menor a 0'); 
			band = "0";
		} else if (soloLetras(cocc)) {
			document.getElementById("costop").classList.remove('Correcto');
			document.getElementById("costop").classList.add('Error');
			alertify.error('Costo Proveedor inválido'); 
			band = "0";
		} else {
			document.getElementById("costop").classList.remove('Error');
			document.getElementById("costop").classList.add('Correcto');
		}
	}
	</script>
	<!-- Modal -->
	<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar Pieza</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevoU">
						<input type="text" hidden="" value="<?php echo $i; ?>" id="idU" name="idU">
						<label>Costo Cliente</label>
						<input type="text" class="form-control input-sm" id="costocU" name="costocU" onfocus="consejoCC()" onfocusout="validarCostoCU()">
						<label>Costo Proveedor</label>
						<input type="text" class="form-control input-sm" id="costopU" name="costopU" onfocus="consejoCP()" onfocusout="validarCostoCPU()">
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
	function validarCostoCU() {
		const coc = document.getElementById('costocU');
		const cocc = coc.value.trim();
		if (cocc === '') {
			document.getElementById("costocU").classList.remove('Correcto');
			document.getElementById("costocU").classList.add('Error');
			alertify.error('Campo "Costo Cliente" vacio'); 
			band = "0";
		} else if (cocc < 0) {
			document.getElementById("costocU").classList.remove('Correcto');
			document.getElementById("costocU").classList.add('Error');
			alertify.error('Costo Cliente menor a 0'); 
			band = "0";
		} else if (soloLetras(cocc)) {
			document.getElementById("costocU").classList.remove('Correcto');
			document.getElementById("costocU").classList.add('Error');
			alertify.error('Costo Cliente inválido'); 
			band = "0";
		} else {
			document.getElementById("costocU").classList.remove('Error');
			document.getElementById("costocU").classList.add('Correcto');
		}
	}

	function validarCostoCPU() {
		const coc = document.getElementById('costopU');
		const cocc = coc.value.trim();
		if (cocc === '') {
			document.getElementById("costopU").classList.remove('Correcto');
			document.getElementById("costopU").classList.add('Error');
			alertify.error('Campo "Costo Proveedor" vacio'); 
			band = "0";
		} else if (cocc < 0) {
			document.getElementById("costopU").classList.remove('Correcto');
			document.getElementById("costopU").classList.add('Error');
			alertify.error('Costo Proveedor menor a 0'); 
			band = "0";
		} else if (soloLetras(cocc)) {
			document.getElementById("costopU").classList.remove('Correcto');
			document.getElementById("costopU").classList.add('Error');
			alertify.error('Costo Proveedor inválido'); 
			band = "0";
		} else {
			document.getElementById("costopU").classList.remove('Error');
			document.getElementById("costopU").classList.add('Correcto');
		}
	}
	</script>

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
	localStorage.setItem("ZZZ", "0");
</script>
<script type="text/php">
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#btnAgregarnuevo').click(function() {
			const nom = document.getElementById('piezaSele');
			const nomm = nom.options[nom.selectedIndex].text;
			const nommm = nom.value.trim();
			const coc = document.getElementById('costoc');
			const cocc = coc.value.trim();
			const cop = document.getElementById('costop');
			const copp = cop.value.trim();
			const pr = document.getElementById('id');
			const prr = pr.value.trim();
			console.log(prr);
			var band = "1";

			if (nommm === '') {
				document.getElementById("nombre").classList.remove('Correcto');
				document.getElementById("nombre").classList.add('Error');
				alertify.error('No hay piezas disponible'); 
				band = "0";
			}

			if (cocc === '') {
				document.getElementById("costoc").classList.remove('Correcto');
				document.getElementById("costoc").classList.add('Error');
				alertify.error('Campo "Costo Cliente" vacio'); 
				band = "0";
			} else if (cocc < 0) {
				document.getElementById("costoc").classList.remove('Correcto');
				document.getElementById("costoc").classList.add('Error');
				alertify.error('Costo Cliente menor a 0'); 
				band = "0";
			} else if (soloLetras(cocc)) {
				document.getElementById("costoc").classList.remove('Correcto');
				document.getElementById("costoc").classList.add('Error');
				alertify.error('Costo Cliente inválido'); 
				band = "0";
			} else {
				document.getElementById("costoc").classList.remove('Error');
				document.getElementById("costoc").classList.add('Correcto');
			}

			if (copp === '') {
				document.getElementById("costop").classList.remove('Correcto');
				document.getElementById("costop").classList.add('Error');
				alertify.error('Campo "Costo Proveedor" vacio'); 
				band = "0";
			} else if (copp < 0) {
				document.getElementById("costop").classList.remove('Correcto');
				document.getElementById("costop").classList.add('Error');
				alertify.error('Costo Proveedor menor a 0'); 
				band = "0";
			} else if (soloLetras(copp)) {
				document.getElementById("costop").classList.remove('Correcto');
				document.getElementById("costop").classList.add('Error');
				alertify.error('Costo costop inválido'); 
				band = "0";
			} else {
				document.getElementById("costop").classList.remove('Error');
				document.getElementById("costop").classList.add('Correcto');
			}

			if (band === "1") {
				document.getElementById("costoc").classList.remove('Error');
				document.getElementById("costoc").classList.remove('Correcto');
				document.getElementById("costoc").classList.remove('Normal');
				document.getElementById("costop").classList.remove('Error');
				document.getElementById("costop").classList.remove('Correcto');
				document.getElementById("costop").classList.remove('Normal');

				datos = $('#frmnuevo').serialize();
				var i = localStorage.getItem("IDD");
				var n = localStorage.getItem("NMM");
				var datos = "proveedor=" + prr + "&pieza=" + nommm + "&costoc=" + cocc + "&costop=" + copp;
				$.ajax({
					type: "POST",
					data: datos,
					url: "procesos/agregarP.php",
					success: function(r) {
						if (r == 1) {
							$('#frmnuevo')[0].reset();
							$('#tablaDatatable').load('tablaM.php');
							alertify.success("agregado con exito");
							localStorage.setItem("ZZZ", "1");
							location.replace("piezas.php?n=" + n + "& i=" + i + "");
						} else {
							alertify.error("Fallo al agregar");
						}
					}
				});
			}
		});

		$('#btnActualizar').click(function() {
			datos = $('#frmnuevoU').serialize();
			const coc = document.getElementById('costocU');
			const cocc = coc.value.trim();
			const cop = document.getElementById('costopU');
			const copp = cop.value.trim();
			var band = "1";

			if (cocc === '') {
				document.getElementById("costocU").classList.remove('Correcto');
				document.getElementById("costocU").classList.add('Error');
				band = "0";
			} else if (cocc < 0) {
				document.getElementById("costocU").classList.remove('Correcto');
				document.getElementById("costocU").classList.add('Error');
				band = "0";
			} else if (soloLetras(cocc)) {
				document.getElementById("costocU").classList.remove('Correcto');
				document.getElementById("costocU").classList.add('Error');
				band = "0";
			} else {
				document.getElementById("costocU").classList.remove('Error');
				document.getElementById("costocU").classList.add('Correcto');
			}

			if (copp === '') {
				document.getElementById("costopU").classList.remove('Correcto');
				document.getElementById("costopU").classList.add('Error');
				band = "0";
			} else if (copp < 0) {
				document.getElementById("costopU").classList.remove('Correcto');
				document.getElementById("costopU").classList.add('Error');
				band = "0";
			} else if (soloLetras(copp)) {
				document.getElementById("costopU").classList.remove('Correcto');
				document.getElementById("costopU").classList.add('Error');
				band = "0";
			} else {
				document.getElementById("costopU").classList.remove('Error');
				document.getElementById("costopU").classList.add('Correcto');
			}

			if (band === "1") {
				document.getElementById("costocU").classList.remove('Error');
				document.getElementById("costocU").classList.remove('Correcto');
				document.getElementById("costocU").classList.remove('Normal');
				document.getElementById("costopU").classList.remove('Error');
				document.getElementById("costopU").classList.remove('Correcto');
				document.getElementById("costopU").classList.remove('Normal');
				var i = localStorage.getItem("IDD");
				var n = localStorage.getItem("NMM");
				$.ajax({
					type: "POST",
					data: datos,
					url: "procesos/actualizarP.php",
					success: function(r) {
						if (r == 1) {
							$('#tablaDatatable').load('tablaM.php');
							localStorage.setItem("ZZZ", "2");
							location.replace("piezas.php?n=" + n + "& i=" + i + "");
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
			url: "procesos/obtenDatosP.php",
			success: function(r) {
				datos = jQuery.parseJSON(r);
				$('#idU').val(datos['id']);
				$('#costocU').val(datos['costoc']);
				$('#costopU').val(datos['costop']);
			}
		});
	}

	function eliminarDatos(id) {
		alertify.confirm('Eliminar Pieza', '¿Seguro que desea eliminar esta Pieza?', function() {

			var i = localStorage.getItem("IDD");
			var n = localStorage.getItem("NMM");
			$.ajax({
				type: "POST",
				data: "id=" + id,
				url: "procesos/eliminarP.php",
				success: function(r) {
					if (r == 1) {
						$('#tablaDatatable').load('tablaM.php');
						localStorage.setItem("ZZZ", "3");
						location.replace("piezas.php?n=" + n + "& i=" + i + "");
						alertify.success("Eliminado con exito !");
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