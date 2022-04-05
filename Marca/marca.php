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
									<a class="nav-item nav-link" href="">Marcas</a>
									<a class="nav-item nav-link" href="../Proveedor/proveedor.php">Proveedor</a>
									<a class="nav-item nav-link" href="../Servicio/servicio.php">Servicio</a>
									<a class="nav-item nav-link" href="../Ventas/Ventas.php">Compras</a>
									<a class="nav-item nav-link" href="../Almacen/almacen.php">Almacen</a>
									<a class="nav-item nav-link" href="../Configuración/Configuración.php">Configuraciones</a>
								</div>
							</div>
						</nav>
					</div>
					<div class="card-body">
						<h1>Marcas
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
					<h5 class="modal-title" id="exampleModalLabel">Agrega nueva Marca</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre" onfocus="nombreN()" onfocusout="validarNombre()">
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
						<input type="text" class="form-control input-sm" id="nombreU" name="nombreU" onfocus="nombreN()" onfocusout="validarNombreU()">
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
	function nombreN() {
		alertify.message('El nombre debe ser mayor o igual a 3 caracteres');
	}
	function validarNombre() {
				const nom = document.getElementById('nombre');
				const nomm = nom.value.trim();
				if (nomm === '') {
					document.getElementById("nombre").classList.remove('Correcto');
					document.getElementById("nombre").classList.add('Error');
					alertify.error('Campo "Nombre" vacio'); 
				} else if (nomm.length < 3) {
					document.getElementById("nombre").classList.remove('Correcto');
					document.getElementById("nombre").classList.add('Error');
					alertify.error('El nombre es demasiado corto'); 
				} else {
					document.getElementById("nombre").classList.remove('Error');
					document.getElementById("nombre").classList.add('Correcto');
				}
			}
			
	function validarNombreU() {
				const nom = document.getElementById('nombreU');
				const nomm = nom.value.trim();
				if (nomm === '') {
					document.getElementById("nombreU").classList.remove('Correcto');
					document.getElementById("nombreU").classList.add('Error');
					alertify.error('Campo "Nombre" vacio'); 
				} else if (nomm.length < 3) {
					document.getElementById("nombreU").classList.remove('Correcto');
					document.getElementById("nombreU").classList.add('Error');
					alertify.error('El nombre es demasiado corto'); 
				} else {
					document.getElementById("nombreU").classList.remove('Error');
					document.getElementById("nombreU").classList.add('Correcto');
				}
			}
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#btnAgregarnuevo').click(function() {
			const nom = document.getElementById('nombre');
			const nomm = nom.value.trim();
			var band = "1";
			if (nomm === '') {
				document.getElementById("nombre").classList.remove('Correcto');
				document.getElementById("nombre").classList.add('Error');
				alertify.error('Campo "Nombre" vacio'); 
				band = "0";
			} else if (nomm.length < 3) {
				document.getElementById("nombre").classList.remove('Correcto');
				document.getElementById("nombre").classList.add('Error');
				alertify.error('El nombre es demasiado corto'); 
				band = "0";
			} else {
				document.getElementById("nombre").classList.remove('Error');
				document.getElementById("nombre").classList.add('Correcto');
			}

			
			if (band === "1") {
				document.getElementById("nombre").classList.remove('Error');
				document.getElementById("nombre").classList.remove('Correcto');
				document.getElementById("nombre").classList.add('Normal');
				datos = document.getElementById('nombre').value
				$.ajax({
					type: "POST",
					data: "nombre=" + datos,
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
			var band = "1";
			if (nomm === '') {
				document.getElementById("nombreU").classList.remove('Correcto');
				document.getElementById("nombreU").classList.add('Error');
				band = "0";
			} else if (nomm.length < 3) {
				document.getElementById("nombreU").classList.remove('Correcto');
				document.getElementById("nombreU").classList.add('Error');
				alertify.error('El nombre es demasiado corto'); 
				band = "0";
			} else {
				document.getElementById("nombreU").classList.remove('Error');
				document.getElementById("nombreU").classList.add('Correcto');
			}
			if (band === "1") {
				document.getElementById("nombreU").classList.remove('Error');
				document.getElementById("nombreU").classList.remove('Correcto');
				document.getElementById("nombreU").classList.add('Normal');
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

	function agregarModelo(id, nombre) {
		$(document).ready(function() {
			const x = id;
			localStorage.setItem("IDD", id);
			localStorage.setItem("NMM", nombre);
			localStorage.setItem("ZZZ", "0");
			location.replace("modelos.php?n=" + nombre + "& i=" + id);
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaDatatable').load('tabla.php');
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
		alertify.confirm('Eliminar Marca', '¿Seguro que desea eliminar este Marca?', function() {

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