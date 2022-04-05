

<?php 

	class conectar{
		public function conexion(){
			$conexion=mysqli_connect('localhost',
										'root',
										'',
										'taller_asc');
			return $conexion;
		}
	}

 ?>