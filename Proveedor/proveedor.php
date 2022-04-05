<!DOCTYPE html>
<html>

<head>
	<title></title>
	<?php require_once "../scripts.php";  ?>
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
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card text-left">
					<div class="card-header">
						<nav class="navbar navbar-expand-lg navbar-light bg-light">
							<a class="navbar-brand">
								<img src="../Untitled - 4.png" width="70" height="39">
							</a>
							<a class="navbar-brand">|</a>
							<a class="navbar-brand">Menu</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
								<div class="navbar-nav">
									<a class="nav-item nav-link" href="../Inicio.php">Inicio <span class="sr-only">(current)</span></a>
									<a class="nav-item nav-link" href="../Clientes/clientes.php">Clientes</a>
									<a class="nav-item nav-link" href="../Marca/marca.php">Marcas</a>
									<a class="nav-item nav-link" href="">Proveedor</a>
									<a class="nav-item nav-link" href="../Servicio/servicio.php">Servicio</a>
									<a class="nav-item nav-link" href="../Ventas/Ventas.php">Compras</a>
									<a class="nav-item nav-link" href="../Almacen/almacen.php">Almacen</a>
									<a class="nav-item nav-link" href="../Configuración/Configuración.php">Configuraciones</a>
								</div>
							</div>
					</div>
					<div class="card-body">
						<h1>Proveedores
						</h1>
					</div>
					<div class="card-body">
						<span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">Agregar nuevo <span class="fa fa-plus-circle"></span>
						</span>
						<hr>
						<div id="tablaDatatable"></div>
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
					<h5 class="modal-title" id="exampleModalLabel">Agrega nuevo Proveedor</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
						<label>Empresa</label>
						<input type="text" class="form-control input-sm" id="empresa" name="empresa" onfocus="consejoE()" onfocusout="validarEmpresa()">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre" onfocus="consejoN()" onfocusout="validarNombre()">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" id="apellido" name="apellido" onfocus="consejoA()" onfocusout="validarApellido()">
						<label>Celular</label>
						<input type="text" class="form-control input-sm" id="celular" name="celular" onfocus="consejoC()" onfocusout="validarCelular()">
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
		function consejoE() {
			alertify.message('La Empresa debe ser mayor o igual a 1 caracteres');
		}
		function consejoN() {
			alertify.message('El Nombre debe ser mayor o igual a 4 caracteres y solo contener letras');
		}
		function consejoA() {
			alertify.message('El Apellido debe ser mayor o igual a 4 caracteres y solo contener letras');
		}
		function consejoC() {
			alertify.message('El Celular debe ser exactamente de 10 caracteres y solo contener números');
		}

		function validarEmpresa() {
			const nom = document.getElementById('empresa');
			const nomm = nom.value.trim();
			if (nomm === '') {
				document.getElementById("empresa").classList.remove('Correcto');
				document.getElementById("empresa").classList.add('Error');
				alertify.error('Campo "Empresa" vacio'); 
				band = "0";
			} else if (nomm.length < 1) {
				document.getElementById("empresa").classList.remove('Correcto');
				document.getElementById("empresa").classList.add('Error');
				alertify.error('La Empresa es demasiado corto'); 
				band = "0";
			} else {
				document.getElementById("empresa").classList.remove('Error');
				document.getElementById("empresa").classList.add('Correcto');
			}
		}

		function validarNombre() {
			const nom = document.getElementById('nombre');
			const nomm = nom.value.trim();
			if (nomm === '') {
				document.getElementById("nombre").classList.remove('Correcto');
				document.getElementById("nombre").classList.add('Error');
				alertify.error('Campo "Nombre" vacio'); 
				band = "0";
			} else if (nomm.length < 4) {
				document.getElementById("nombre").classList.remove('Correcto');
				document.getElementById("nombre").classList.add('Error');
				alertify.error('El nombre es demasiado corto'); 
				band = "0";
			} else if (!soloLetras(nomm)) {
				document.getElementById("nombre").classList.remove('Correcto');
				document.getElementById("nombre").classList.add('Error');
				alertify.error('El campo "Nombre" solo puede contener letras'); 
				band = "0";
			} else {
				document.getElementById("nombre").classList.remove('Error');
				document.getElementById("nombre").classList.add('Correcto');
			}
		}

		function validarApellido() {
			const nom = document.getElementById('apellido');
			const nomm = nom.value.trim();
			if (nomm === '') {
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Error');
				alertify.error('Campo "Apellido" vacio'); 
				band = "0";
			} else if (nomm.length < 4) {
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Error');
				alertify.error('El apellido es demasiado corto'); 
				band = "0";
			} else if (!soloLetras(nomm)) {
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Error');
				alertify.error('El campo "Apellido" solo puede contener letras'); 
				band = "0";
			} else {
				document.getElementById("apellido").classList.remove('Error');
				document.getElementById("apellido").classList.add('Correcto');
			}
		}
		
		function validarCelular() {
			const cel = document.getElementById('celular');
			const cell = cel.value.trim();
			if (cell === '') {
				document.getElementById("celular").classList.remove('Correcto');
				document.getElementById("celular").classList.add('Error');
				alertify.error('Campo "Celular" vacio'); 
			} else if (soloLetras(cell)) {
				document.getElementById("celular").classList.remove('Correcto');
				document.getElementById("celular").classList.add('Error');
				alertify.error('El campo "Celular" solo puede contener numeros'); 
			} else if (cell.length != 10) {
				document.getElementById("celular").classList.remove('Correcto');
				document.getElementById("celular").classList.add('Error');
				alertify.error('Un Celular valido contiene 10 caracteres'); 
			} else {
				document.getElementById("celular").classList.remove('Error');
				document.getElementById("celular").classList.add('Correcto');
			}
		}

	</script>

	<!-- Modal -->
	<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar Proveedor</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevoU">
						<input type="text" hidden="" id="id" name="id">
						<label>Empresa</label>
						<input type="text" class="form-control input-sm" id="empresaU" name="empresaU" onfocus="consejoE()" onfocusout="validarEmpresaU()">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombreU" name="nombreU" onfocus="consejoN()" onfocusout="validarNombreU()">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" id="apellidoU" name="apellidoU" onfocus="consejoA()" onfocusout="validarApellidoU()">
						<label>Celular</label>
						<input type="text" class="form-control input-sm" id="celularU" name="celularU" onfocus="consejoC()" onfocusout="validarCelularU()">
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
		function validarEmpresaU() {
			const nom = document.getElementById('empresaU');
			const nomm = nom.value.trim();
			if (nomm === '') {
				document.getElementById("empresaU").classList.remove('Correcto');
				document.getElementById("empresaU").classList.add('Error');
				alertify.error('Campo "Empresa" vacio'); 
				band = "0";
			} else if (nomm.length < 1) {
				document.getElementById("empresaU").classList.remove('Correcto');
				document.getElementById("empresaU").classList.add('Error');
				alertify.error('La Empresa es demasiado corto'); 
				band = "0";
			} else {
				document.getElementById("empresaU").classList.remove('Error');
				document.getElementById("empresaU").classList.add('Correcto');
			}
		}

		function validarNombreU() {
			const nom = document.getElementById('nombreU');
			const nomm = nom.value.trim();
			if (nomm === '') {
				document.getElementById("nombreU").classList.remove('Correcto');
				document.getElementById("nombreU").classList.add('Error');
				alertify.error('Campo "Nombre" vacio'); 
				band = "0";
			} else if (nomm.length < 4) {
				document.getElementById("nombreU").classList.remove('Correcto');
				document.getElementById("nombreU").classList.add('Error');
				alertify.error('El nombre es demasiado corto'); 
				band = "0";
			} else if (!soloLetras(nomm)) {
				document.getElementById("nombreU").classList.remove('Correcto');
				document.getElementById("nombreU").classList.add('Error');
				alertify.error('El campo "Nombre" solo puede contener letras'); 
				band = "0";
			} else {
				document.getElementById("nombreU").classList.remove('Error');
				document.getElementById("nombreU").classList.add('Correcto');
			}
		}

		function validarApellidoU() {
			const nom = document.getElementById('apellidoU');
			const nomm = nom.value.trim();
			if (nomm === '') {
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Error');
				alertify.error('Campo "Apellido" vacio'); 
				band = "0";
			} else if (nomm.length < 4) {
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Error');
				alertify.error('El apellido es demasiado corto'); 
				band = "0";
			} else if (!soloLetras(nomm)) {
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Error');
				alertify.error('El campo "Apellido" solo puede contener letras'); 
				band = "0";
			} else {
				document.getElementById("apellidoU").classList.remove('Error');
				document.getElementById("apellidoU").classList.add('Correcto');
			}
		}
		
		function validarCelularU() {
			const cel = document.getElementById('celularU');
			const cell = cel.value.trim();
			if (cell === '') {
				document.getElementById("celularU").classList.remove('Correcto');
				document.getElementById("celularU").classList.add('Error');
				alertify.error('Campo "Celular" vacio'); 
			} else if (soloLetras(cell)) {
				document.getElementById("celularU").classList.remove('Correcto');
				document.getElementById("celularU").classList.add('Error');
				alertify.error('El campo "Celular" solo puede contener numeros'); 
			} else if (cell.length != 10) {
				document.getElementById("celularU").classList.remove('Correcto');
				document.getElementById("celularU").classList.add('Error');
				alertify.error('Un Celular valido contiene 10 caracteres'); 
			} else {
				document.getElementById("celularU").classList.remove('Error');
				document.getElementById("celularU").classList.add('Correcto');
			}
		}
		
</script>
 
<script type="text/javascript">
	function piezas(id, nombre) {
		$(document).ready(function() {
			const x = id;
			localStorage.setItem("IDD", id);
			localStorage.setItem("NMM", nombre);
			localStorage.setItem("ZZZ", "0");
			location.replace("piezas.php?n=" + nombre + "& i=" + id);
		});
	}

	function pedidos(id, nombre) {
		$(document).ready(function() {
			const x = id;
			localStorage.setItem("IDD", id);
			localStorage.setItem("NMM", nombre);
			localStorage.setItem("ZZZ", "0");
			location.replace("pedidos.php?n=" + nombre + "& i=" + id);
		});
	}

	$(document).ready(function() {
		$('#btnAgregarnuevo').click(function() {
			const emp = document.getElementById('empresa');
			const empp = emp.value.trim();
			const nom = document.getElementById('nombre');
			const nomm = nom.value.trim();
			const ape = document.getElementById('apellido');
			const apee = ape.value.trim();
			const cel = document.getElementById('celular');
			const cell = cel.value.trim();
			var band = "1";

			if (empp === '') {
				document.getElementById("empresa").classList.remove('Correcto');
				document.getElementById("empresa").classList.add('Error');
				alertify.error('Campo "Empresa" vacio'); 
				band = "0";
			} else if (empp.length < 1) {
				document.getElementById("empresa").classList.remove('Correcto');
				document.getElementById("empresa").classList.add('Error');
				alertify.error('Campo "Empresa" demasiado corto'); 
				band = "0";
			} else {
				document.getElementById("empresa").classList.remove('Error');
				document.getElementById("empresa").classList.add('Correcto');
			}

			if (nomm === '') {
				document.getElementById("nombre").classList.remove('Correcto');
				document.getElementById("nombre").classList.add('Error');
				alertify.error('Campo "Nombre" vacio'); 
				band = "0";
			} else if (nomm.length < 4) {
				document.getElementById("nombre").classList.remove('Correcto');
				document.getElementById("nombre").classList.add('Error');
				alertify.error('Campo "Nombre" demasiado corto'); 
				band = "0";
			} else if (!soloLetras(nomm)) {
				document.getElementById("nombre").classList.remove('Correcto');
				document.getElementById("nombre").classList.add('Error');
				alertify.error('Campo "Nombre" inválido'); 
				band = "0";
			} else {
				document.getElementById("nombre").classList.remove('Error');
				document.getElementById("nombre").classList.add('Correcto');
			}

			if (apee === '') {
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Error');
				alertify.error('Campo "Apellido" vacio'); 
				band = "0";
			} else if (apee.length < 4) {
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Error');
				alertify.error('Campo "Apellido" demasiado corto'); 
				band = "0";
			} else if (!soloLetras(apee)) {
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Error');
				alertify.error('Campo "Apellido" inválido'); 
				band = "0";
			} else {
				document.getElementById("apellido").classList.remove('Error');
				document.getElementById("apellido").classList.add('Correcto');
			}

			if (cell === '') {
				document.getElementById("celular").classList.remove('Correcto');
				document.getElementById("celular").classList.add('Error');
				alertify.error('Campo "Celular" vacio'); 
				band = "0";
			} else if (cell.length != 10) {
				document.getElementById("celular").classList.remove('Correcto');
				document.getElementById("celular").classList.add('Error');
				alertify.error('Campo "Celular" inválido'); 
				band = "0";
			} else if (soloLetras(cell)) {
				document.getElementById("celular").classList.remove('Correcto');
				document.getElementById("celular").classList.add('Error');
				alertify.error('Campo "Celular" inválido'); 
				band = "0";
			} else {
				document.getElementById("celular").classList.remove('Error');
				document.getElementById("celular").classList.add('Correcto');
			}


			if (band === "1") {
				document.getElementById("empresa").classList.remove('Error');
				document.getElementById("empresa").classList.remove('Correcto');
				document.getElementById("empresa").classList.add('Normal');
				document.getElementById("nombre").classList.remove('Error');
				document.getElementById("nombre").classList.remove('Correcto');
				document.getElementById("nombre").classList.add('Normal');
				document.getElementById("apellido").classList.remove('Error');
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Normal');
				document.getElementById("celular").classList.remove('Error');
				document.getElementById("celular").classList.remove('Correcto');
				document.getElementById("celular").classList.add('Normal');
				datos = $('#frmnuevo').serialize();

				$.ajax({
					type: "POST",
					data: datos,
					url: "procesos/agregar.php",
					success: function(r) {
						if (r == 1) {
							$('#frmnuevo')[0].reset();
							$('#tablaDatatable').load('tabla.php');
							alertify.success("agregado con exito");
						} else {
							alertify.error("Fallo al agregar");
						}
					}
				});
			}
		});

		$('#btnActualizar').click(function() {

			const emp = document.getElementById('empresaU');
			const empp = emp.value.trim();
			const nom = document.getElementById('nombreU');
			const nomm = nom.value.trim();
			const ape = document.getElementById('apellidoU');
			const apee = ape.value.trim();
			const cel = document.getElementById('celularU');
			const cell = cel.value.trim();
			var band = "1";

			if (empp === '') {
				document.getElementById("empresaU").classList.remove('Correcto');
				document.getElementById("empresaU").classList.add('Error');
				alertify.error('Campo "Empresa" vacio'); 
				band = "0";
			} else if (empp.length < 1) {
				document.getElementById("empresaU").classList.remove('Correcto');
				document.getElementById("empresaU").classList.add('Error');
				alertify.error('Campo "Empresa" demasiado corto'); 
				band = "0";
			} else if (!soloLetras(empp)) {
				document.getElementById("empresaU").classList.remove('Correcto');
				document.getElementById("empresaU").classList.add('Error');
				alertify.error('Campo "Empresa" inválido'); 
				band = "0";
			} else {
				document.getElementById("empresaU").classList.remove('Error');
				document.getElementById("empresaU").classList.add('Correcto');
			}

			if (nomm === '') {
				document.getElementById("nombreU").classList.remove('Correcto');
				document.getElementById("nombreU").classList.add('Error');
				alertify.error('Campo "Nombre" vacio'); 
				band = "0";
			} else if (nomm.length < 4) {
				document.getElementById("nombreU").classList.remove('Correcto');
				document.getElementById("nombreU").classList.add('Error');
				alertify.error('Campo "Nombre" demasiado corto'); 
				band = "0";
			} else if (!soloLetras(nomm)) {
				document.getElementById("nombreU").classList.remove('Correcto');
				document.getElementById("nombreU").classList.add('Error');
				alertify.error('Campo "Nombre" inválido'); 
				band = "0";
			} else {
				document.getElementById("nombreU").classList.remove('Error');
				document.getElementById("nombreU").classList.add('Correcto');
			}

			if (apee === '') {
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Error');
				alertify.error('Campo "Apellido" vacio'); 
				band = "0";
			} else if (apee.length < 4) {
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Error');
				alertify.error('Campo "Apellido" demasiado corto'); 
				band = "0";
			} else if (!soloLetras(apee)) {
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Error');
				alertify.error('Campo "Apellido" inválido'); 
				band = "0";
			} else {
				document.getElementById("apellidoU").classList.remove('Error');
				document.getElementById("apellidoU").classList.add('Correcto');
			}

			if (cell === '') {
				document.getElementById("celularU").classList.remove('Correcto');
				document.getElementById("celularU").classList.add('Error');
				alertify.error('Campo "Celular" vacio'); 
				band = "0";
			} else if (cell.length != 10) {
				document.getElementById("celularU").classList.remove('Correcto');
				document.getElementById("celularU").classList.add('Error');
				alertify.error('Campo "Celular" inválido'); 
				band = "0";
			} else if (soloLetras(cell)) {
				document.getElementById("celularU").classList.remove('Correcto');
				document.getElementById("celularU").classList.add('Error');
				alertify.error('Campo "Celular" inválido'); 
				band = "0";
			} else {
				document.getElementById("celularU").classList.remove('Error');
				document.getElementById("celularU").classList.add('Correcto');
			}


			if (band === "1") {
				document.getElementById("empresaU").classList.remove('Error');
				document.getElementById("empresaU").classList.remove('Correcto');
				document.getElementById("empresaU").classList.add('Normal');
				document.getElementById("nombreU").classList.remove('Error');
				document.getElementById("nombreU").classList.remove('Correcto');
				document.getElementById("nombreU").classList.add('Normal');
				document.getElementById("apellidoU").classList.remove('Error');
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Normal');
				document.getElementById("celularU").classList.remove('Error');
				document.getElementById("celularU").classList.remove('Correcto');
				document.getElementById("celularU").classList.add('Normal');
				datos = $('#frmnuevoU').serialize();

				$.ajax({
					type: "POST",
					data: datos,
					url: "procesos/actualizar.php",
					success: function(r) {
						if (r == 1) {
							$('#tablaDatatable').load('tabla.php');
							alertify.success("Actualizado con exito ");
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
		$('#tablaDatatable').load('tabla.php');
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
				$('#empresaU').val(datos['empresa']);
				$('#nombreU').val(datos['nombre']);
				$('#apellidoU').val(datos['apellido']);
				$('#celularU').val(datos['celular']);
			}
		});
	}

	function eliminarDatos(id) {
		alertify.confirm('Eliminar Proveedor', '¿Seguro que desea eliminar este Proveedor?', function() {

			$.ajax({
				type: "POST",
				data: "id=" + id,
				url: "procesos/eliminar.php",
				success: function(r) {
					if (r == 1) {
						$('#tablaDatatable').load('tabla.php');
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