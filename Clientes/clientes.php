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
									<a class="nav-item nav-link" href="">Clientes</a>
									<a class="nav-item nav-link" href="../Marca/marca.php">Marcas</a>
									<a class="nav-item nav-link" href="../Proveedor/proveedor.php">Proveedor</a>
									<a class="nav-item nav-link" href="../Servicio/servicio.php">Servicio</a>
									<a class="nav-item nav-link" href="../Ventas/Ventas.php">Compras</a>
									<a class="nav-item nav-link" href="../Almacen/almacen.php">Almacen</a>
									<a class="nav-item nav-link" href="../Configuración/Configuración.php">Configuraciones</a>
								</div>
							</div>
					</div>
					<div class="card-body">
						<h1>Clientes
						</h1>
					</div>
					<div class="card-body">
						<span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
							Agregar nuevo <span class="fa fa-plus-circle"></span>
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
					<h5 class="modal-title" id="exampleModalLabel">Agrega nuevo Cliente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo" action="/action_page.php">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre" onfocus="consejoN()" onfocusout="validarNombre()" >
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" id="apellido" name="apellido" onfocus="consejoA()" onfocusout="validarApellido()">
						<label>Celular</label>
						<input type="text" class="form-control input-sm" id="celular" name="celular" onfocus="consejoC()" onfocusout="validarCelular()">
						<label>Correo</label>
						<input type="text" class="form-control" id="correo" name="correo" onfocus="consejoCr()" onfocusout="validarCorreo()">
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="button" id="btnAgregarnuevo" class="btn btn-primary">Agregar nuevo</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> 
	<script>
		function consejoN() {
			alertify.message('EL nombre debe ser mayor o igual a 4 caracteres y solo contener letras');
		}
		function consejoA() {
			alertify.message('El Apellido debe ser mayor o igual a 4 caracteres y solo contener letras');
		}
		function consejoC() {
			alertify.message('El n Celular debe ser exactamente de 10 caracteres y solo contener números');
		}
		function consejoCr() {
			alertify.message('Formato de un Correo - "ejemplo@algo.com"');
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
			const ape = document.getElementById('apellido');
			const apee = ape.value.trim();
			if (apee === '') {
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Error');
				alertify.error('Campo "Apellido" vacio'); 
			} else if (apee.length < 4) {
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Error');
				alertify.error('El apellido es demasiado corto'); 
			} else if (!soloLetras(apee)) {
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Error');
				alertify.error('El campo "Apellido" solo puede contener letras'); 
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

		function validarCorreo() {
			const email = document.getElementById('correo');
			const emaill = email.value.trim();
			if (emaill === '') {
				document.getElementById("correo").classList.remove('Correcto');
				document.getElementById("correo").classList.add('Error');
				alertify.error('Campo "Correo" vacio'); 
			} else if (!isEmail(emaill)) {
				document.getElementById("correo").classList.remove('Correcto');
				document.getElementById("correo").classList.add('Error');
				alertify.error('Campo "Correo" formatio incorrecto - "ejemplo@algo.com"'); 
			} else {
				document.getElementById("correo").classList.remove('Error');
				document.getElementById("correo").classList.add('Correcto');
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
			const ape = document.getElementById('apellidoU');
			const apee = ape.value.trim();
			if (apee === '') {
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Error');
				alertify.error('Campo "Apellido" vacio'); 
			} else if (apee.length < 4) {
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Error');
				alertify.error('El apellido es demasiado corto'); 
			} else if (!soloLetras(apee)) {
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Error');
				alertify.error('El campo "Apellido" solo puede contener letras'); 
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

		function validarCorreoU() {
			const email = document.getElementById('correoU');
			const emaill = email.value.trim();
			if (emaill === '') {
				document.getElementById("correoU").classList.remove('Correcto');
				document.getElementById("correoU").classList.add('Error');
				alertify.error('Campo "Correo" vacio'); 
			} else if (!isEmail(emaill)) {
				document.getElementById("correoU").classList.remove('Correcto');
				document.getElementById("correoU").classList.add('Error');
				alertify.error('Campo "Correo" formatio incorrecto - "ejemplo@algo.com"'); 
			} else {
				document.getElementById("correoU").classList.remove('Error');
				document.getElementById("correoU").classList.add('Correcto');
			}
		}

	</script>
	<!-- Modal -->
	<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar Cliente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevoU">
						<input type="text" hidden="" id="id" name="id">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombreU" name="nombreU"  onfocus="consejoN()" onfocusout="validarNombreU()">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" id="apellidoU" name="apellidoU" onfocus="consejoA()" onfocusout="validarApellidoU()">
						<label>Celular</label>
						<input type="text" class="form-control input-sm" id="celularU" name="celularU"  onfocus="consejoC()" onfocusout="validarCelularU()">
						<label>Correo</label>
						<input type="text" class="form-control input-sm" id="correoU" name="correoU" onfocus="consejoCr()" onfocusout="validarCorreoU()">
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

<script type="text/javascript">
	function agregarVehiculo(id, nombre, apellido) {
		$(document).ready(function() {
			const x = id;
			localStorage.setItem("IDD", id);
			localStorage.setItem("NMM", nombre);
			localStorage.setItem("ZZZ", "0");
			localStorage.setItem("iV", id);
			localStorage.setItem("nV", (nombre + " " + apellido));
			location.replace("vehiculos.php?n=" + (nombre + " " + apellido) + "& i=" + id);
		});
	}

	$(document).ready(function() {
		$('#btnAgregarnuevo').click(function() {
			const nom = document.getElementById('nombre');
			const nomm = nom.value.trim();
			const ape = document.getElementById('apellido');
			const apee = ape.value.trim();
			const cel = document.getElementById('celular');
			const cell = cel.value.trim();
			const email = document.getElementById('correo');
			const emaill = email.value.trim();
			var band = "1";

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

			if (apee === '') {
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Error');
				alertify.error('Campo "Apellido" vacio'); 
				band = "0";
			} else if (apee.length < 4) {
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Error');
				alertify.error('El apellido es demasiado corto'); 
				band = "0";
			} else if (!soloLetras(apee)) {
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Error');
				alertify.error('El campo "Apellido" solo puede contener letras'); 
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
			} else if (soloLetras(cell)) {
				document.getElementById("celular").classList.remove('Correcto');
				document.getElementById("celular").classList.add('Error');
				alertify.error('El campo "Celular" solo puede contener numeros'); 
				band = "0";
			} else if (cell.length != 10) {
				document.getElementById("celular").classList.remove('Correcto');
				document.getElementById("celular").classList.add('Error');
				alertify.error('Un Celular valido contiene 10 caracteres'); 
				band = "0";
			} else {
				document.getElementById("celular").classList.remove('Error');
				document.getElementById("celular").classList.add('Correcto');
			}

			if (emaill === '') {
				document.getElementById("correo").classList.remove('Correcto');
				document.getElementById("correo").classList.add('Error');
				alertify.error('Campo "Correo" vacio'); 
				band = "0";
			} else if (!isEmail(emaill)) {
				document.getElementById("correo").classList.remove('Correcto');
				document.getElementById("correo").classList.add('Error');
				alertify.error('Campo "Correo" formatio incorrecto - "ejemplo@algo.com"'); 
				band = "0";
			} else {
				document.getElementById("correo").classList.remove('Error');
				document.getElementById("correo").classList.add('Correcto');
			}

			if (band === "1") {
				document.getElementById("nombre").classList.remove('Error');
				document.getElementById("nombre").classList.remove('Correcto');
				document.getElementById("nombre").classList.add('Normal');
				document.getElementById("apellido").classList.remove('Error');
				document.getElementById("apellido").classList.remove('Correcto');
				document.getElementById("apellido").classList.add('Normal');
				document.getElementById("celular").classList.remove('Error');
				document.getElementById("celular").classList.remove('Correcto');
				document.getElementById("celular").classList.add('Normal');
				document.getElementById("correo").classList.remove('Error');
				document.getElementById("correo").classList.remove('Correcto');
				document.getElementById("correo").classList.add('Normal');
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
			const nom = document.getElementById('nombreU');
			const nomm = nom.value.trim();
			const ape = document.getElementById('apellidoU');
			const apee = ape.value.trim();
			const cel = document.getElementById('celularU');
			const cell = cel.value.trim();
			const email = document.getElementById('correoU');
			const emaill = email.value.trim();
			var band = "1";

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

			if (apee === '') {
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Error');
				alertify.error('Campo "Apellido" vacio'); 
				band = "0";
			} else if (apee.length < 4) {
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Error');
				alertify.error('El apellido es demasiado corto'); 
				band = "0";
			} else if (!soloLetras(apee)) {
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Error');
				alertify.error('El campo "Apellido" solo puede contener letras'); 
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
			} else if (soloLetras(cell)) {
				document.getElementById("celularU").classList.remove('Correcto');
				document.getElementById("celularU").classList.add('Error');
				alertify.error('El campo "Celular" solo puede contener numeros'); 
				band = "0";
			} else if (cell.length != 10) {
				document.getElementById("celularU").classList.remove('Correcto');
				document.getElementById("celularU").classList.add('Error');
				alertify.error('Un Celular valido contiene 10 caracteres'); 
				band = "0";
			} else {
				document.getElementById("celularU").classList.remove('Error');
				document.getElementById("celularU").classList.add('Correcto');
			}

			if (emaill === '') {
				document.getElementById("correoU").classList.remove('Correcto');
				document.getElementById("correoU").classList.add('Error');
				alertify.error('Campo "Correo" vacio'); 
				band = "0";
			} else if (!isEmail(emaill)) {
				document.getElementById("correoU").classList.remove('Correcto');
				document.getElementById("correoU").classList.add('Error');
				alertify.error('Campo "Correo" formatio incorrecto - "ejemplo@algo.com"'); 
				band = "0";
			} else {
				document.getElementById("correoU").classList.remove('Error');
				document.getElementById("correoU").classList.add('Correcto');
			}

			if (band === "1") {
				document.getElementById("nombreU").classList.remove('Error');
				document.getElementById("nombreU").classList.remove('Correcto');
				document.getElementById("nombreU").classList.add('Normal');
				document.getElementById("apellidoU").classList.remove('Error');
				document.getElementById("apellidoU").classList.remove('Correcto');
				document.getElementById("apellidoU").classList.add('Normal');
				document.getElementById("celularU").classList.remove('Error');
				document.getElementById("celularU").classList.remove('Correcto');
				document.getElementById("celularU").classList.add('Normal');
				document.getElementById("correoU").classList.remove('Error');
				document.getElementById("correoU").classList.remove('Correcto');
				document.getElementById("correoU").classList.add('Normal');

				datos = $('#frmnuevoU').serialize();

				$.ajax({
					type: "POST",
					data: datos,
					url: "procesos/actualizar.php",
					success: function(r) {
						if (r == 1) {
							$('#tablaDatatable').load('tabla.php');
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
				$('#apellidoU').val(datos['apellido']);
				$('#celularU').val(datos['celular']);
				$('#correoU').val(datos['correo']);
			}
		});
	}

	function eliminarDatos(id) {
		alertify.confirm('Eliminar Cliente', '¿Seguro que desea eliminar este Cliente?', function() {

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