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
										<td>Pieza</td>
										<td>Cantidad</td>
										<td>Costo</td>
										<td>Editar</td>
										<td>Finalizar</td>
										<td>Cancelar</td>
									</tr>
								</thead>
								<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
									<tr>
										<td>Pieza</td>
										<td>Cantidad</td>
										<td>Costo</td>
										<td>Editar</td>
										<td>Finalizar</td>
										<td>Cancelar</td>
									</tr>
								</tfoot>
								<tbody>
									<?php

									$sql = "SELECT * FROM pedido WHERE Proveedor = $i and Estado=1";
									$result = mysqli_query($conexion, $sql);
									while ($mostrar = mysqli_fetch_row($result)) {
										$sql2 = "SELECT CostoP FROM idpiezas WHERE ID = $mostrar[2]";
										$result2 = mysqli_query($conexion, $sql2);
										$mostrar2 = mysqli_fetch_row($result2);
										$sql3 = "SELECT Nombre FROM piezas WHERE ID = $mostrar[2] and Visible =1 ";
										$result3 = mysqli_query($conexion, $sql3);
										$mostrar3 = mysqli_fetch_row($result3);
									?>
										<tr>
											<td><?php echo $mostrar3[0] ?></td>
											<td><?php echo $mostrar[3] ?></td>
											<td><?php echo ($mostrar[4]) ?></td>
											<td style="text-align: center;">
												<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizar('<?php echo $mostrar[0] ?>')">
													<span class="fa fa-pencil-square-o"></span>
												</span>
											</td>
											<td style="text-align: center;">
												<span class="btn btn-success btn-sm" onclick="finalizar('<?php echo $mostrar[0] ?>')">
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
							$sql = "SELECT * FROM idpiezas where Proveedor='$i'";
							$query = $conexion->query($sql);
							while ($valores = mysqli_fetch_array($query)) {
								$sql = "SELECT Nombre from piezas where ID='$valores[1]' and Visible = 1";
								$result = mysqli_query($conexion, $sql);
								$ver = mysqli_fetch_row($result);
								if ($ver != null){
									echo "<option value='" . $valores[1] . "'>" . $ver[0] . "</option>";
								}
							}
							?>
						</select>
						<label>Cantidad</label>
						<input type="text" class="form-control input-sm" id="cantidad" name="cantidad" value="0" onfocus="consejoCC()" onfocusout="validarCostoC()">
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
			alertify.message('La cantidad debe ser mayor o igual a 0');
		}
		function consejoCP() {
			alertify.message('El Costo debe ser igual o mayor a 0');
		}
		function validarCostoC() {
			const coc = document.getElementById('cantidad');
			const cocc = coc.value.trim();
			if (cocc === '') {
				document.getElementById("cantidad").classList.remove('Correcto');
				document.getElementById("cantidad").classList.add('Error');
				alertify.error('Campo "Cantidad" vacio'); 
				band = "0";
			} else if (cocc < 0) {
				document.getElementById("cantidad").classList.remove('Correcto');
				document.getElementById("cantidad").classList.add('Error');
				alertify.error('Cantidad menor a 0'); 
				band = "0";
			} else if (soloLetras(cocc)) {
				document.getElementById("cantidad").classList.remove('Correcto');
				document.getElementById("cantidad").classList.add('Error');
				alertify.error('Cantidad inválido'); 
				band = "0";
			} else {
				document.getElementById("cantidad").classList.remove('Error');
				document.getElementById("cantidad").classList.add('Correcto');
			}
		}
	</script>
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
						<input type="text" class="form-control input-sm" id="cantidadU" name="cantidadU"  onfocus="consejoCC()" onfocusout="validarCostoCU()">
						<label>Costo</label>
						<input type="text" class="form-control input-sm" id="costoU" name="costoU" onfocus="consejoCP()" onfocusout="validarCostoCPU()">
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
	function validarCostoCU() {
		const coc = document.getElementById('cantidadU');
		const cocc = coc.value.trim();
			if (cocc === '') {
				document.getElementById("cantidadU").classList.remove('Correcto');
				document.getElementById("cantidadU").classList.add('Error');
				alertify.error('Campo "Cantidad" vacio'); 
				band = "0";
			} else if (cocc < 0) {
				document.getElementById("cantidadU").classList.remove('Correcto');
				document.getElementById("cantidadU").classList.add('Error');
				alertify.error('Cantidad menor a 0'); 
				band = "0";
			} else if (soloLetras(cocc)) {
				document.getElementById("cantidadU").classList.remove('Correcto');
				document.getElementById("cantidadU").classList.add('Error');
				alertify.error('Cantidad inválido'); 
				band = "0";
			} else {
				document.getElementById("cantidadU").classList.remove('Error');
				document.getElementById("cantidadU").classList.add('Correcto');
			}
		}
		
		function validarCostoCPU() {
			const coc = document.getElementById('costoU');
			const cocc = coc.value.trim();
			if (cocc === '') {
				document.getElementById("costoU").classList.remove('Correcto');
				document.getElementById("costoU").classList.add('Error');
				alertify.error('Campo "Costo" vacio'); 
				band = "0";
			} else if (cocc < 0) {
				document.getElementById("costoU").classList.remove('Correcto');
				document.getElementById("costoU").classList.add('Error');
				alertify.error('Costo menor a 0'); 
				band = "0";
			} else if (soloLetras(cocc)) {
				document.getElementById("costoU").classList.remove('Correcto');
				document.getElementById("costoU").classList.add('Error');
				alertify.error('Costo inválido'); 
				band = "0";
			} else {
				document.getElementById("costoU").classList.remove('Error');
				document.getElementById("costoU").classList.add('Correcto');
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
			} catch (error) {
				alertify.error('No hay piezas disponible'); 
			}
			if (xx === '') {
				document.getElementById("cantidad").classList.remove('Correcto');
				document.getElementById("cantidad").classList.add('Error');
				band = "0";
			}

			if (caa === '') {
				document.getElementById("cantidad").classList.remove('Correcto');
				document.getElementById("cantidad").classList.add('Error');
				alertify.error('Campo "Cantidad" vacio'); 
				band = "0";
			} else if (caa < 0) {
				document.getElementById("cantidad").classList.remove('Correcto');
				document.getElementById("cantidad").classList.add('Error');
				alertify.error('Cantidad menor a 0'); 
				band = "0";
			} else if (soloLetras(caa)) {
				document.getElementById("cantidad").classList.remove('Correcto');
				document.getElementById("cantidad").classList.add('Error');
				alertify.error('Cantidad inválido'); 
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
				alertify.error('Campo "Cantidad" vacio'); 
				band = "0";
			} else if (caa < 0) {
				document.getElementById("cantidadU").classList.remove('Correcto');
				document.getElementById("cantidadU").classList.add('Error');
				alertify.error('Cantidad menor a 0'); 
				band = "0";
			} else if (soloLetras(caa)) {
				document.getElementById("cantidadU").classList.remove('Correcto');
				document.getElementById("cantidadU").classList.add('Error');
				alertify.error('Cantidad inválido'); 
				band = "0";
			} else {
				document.getElementById("cantidadU").classList.remove('Error');
				document.getElementById("cantidadU").classList.add('Correcto');
			}

			if (cos === '') {
				document.getElementById("costoU").classList.remove('Correcto');
				document.getElementById("costoU").classList.add('Error');
				alertify.error('Campo "Costo" vacio'); 
				band = "0";
			} else if (cos < 0) {
				document.getElementById("costoU").classList.remove('Correcto');
				document.getElementById("costoU").classList.add('Error');
				alertify.error('Costo menor a 0'); 
				band = "0";
			} else if (soloLetras(cos)) {
				document.getElementById("costoU").classList.remove('Correcto');
				document.getElementById("costoU").classList.add('Error');
				alertify.error('Costo Inválido'); 
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