<?php 
class crud{


	
public function obtenDatosSSS(){
	$obj= new conectar();
	$conexion=$obj->conexion();

	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/cliente.txt' FROM cliente";
	mysqli_query($conexion,$sql);
	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/idpiezas.txt' FROM idpiezas";
	mysqli_query($conexion,$sql);
	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/idtrabajo.txt' FROM idtrabajo";
	mysqli_query($conexion,$sql);
	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/marca.txt' FROM marca";
	mysqli_query($conexion,$sql);
	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/modelo.txt' FROM modelo";
	mysqli_query($conexion,$sql);
	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/pedido.txt' FROM pedido";
	mysqli_query($conexion,$sql);
	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/piezas.txt' FROM piezas";
	mysqli_query($conexion,$sql);
	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/piezasser.txt' FROM piezasser";
	mysqli_query($conexion,$sql);
	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/proveedor.txt' FROM proveedor";
	mysqli_query($conexion,$sql);
	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/servicio.txt' FROM servicio";
	mysqli_query($conexion,$sql);
	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/trabajo.txt' FROM trabajo";
	mysqli_query($conexion,$sql);
	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/usuario.txt' FROM usuario";
	mysqli_query($conexion,$sql);
	$sql="SELECT * INTO OUTFILE 'C:/Users/geranpio/Desktop/Respaldo/vehiculo.txt' FROM vehiculo";
	mysqli_query($conexion,$sql);
	return 1;
}

	public function agregar($datos){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT into piezas (Nombre, Existencia) 
		values ('$datos[0]','$datos[1]')";
		return mysqli_query($conexion,$sql);
	}


	public function actualizar($datos){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE color set colot ='$datos[1]' where colot='$datos[0]'";
		mysqli_query($conexion,$sql);
		return $sql;
	}


	
	public function eliminar($id){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE piezas set Visible='0' where ID='$id'";
		return mysqli_query($conexion,$sql);
	}
	
	public function ama($id){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE color set colot ='DEC239' where colot='$id'";
		mysqli_query($conexion,$sql);
		return $sql;
	}
	
	public function azl($id){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE color set colot ='3977DE' where colot='$id'";
		return mysqli_query($conexion,$sql);
	}
	
	public function per($id){
		$obj= new conectar();
		$conexion=$obj->conexion();
		
		$sql="UPDATE piezas set Visible='0' where ID='$id'";
		return mysqli_query($conexion,$sql);
	}
	
	public function roj($id){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE color set colot ='dc3545' where colot='$id'";
		return mysqli_query($conexion,$sql);
	}
	
	public function ver($id){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE color set colot ='39DE79' where colot='$id'";
		mysqli_query($conexion,$sql);
		return 1;
	}






	public function obtenDatos(){
		$obj= new conectar();
		$conexion=$obj->conexion();
		$sqwwl="CREATE TABLE `cliente` (
				`ID` int(6) NOT NULL,
				`Nombre` varchar(20) NOT NULL,
				`Apellido` varchar(20) NOT NULL,
				`Celular` varchar(20) NOT NULL,
				`Correo` varchar(50) NOT NULL,
				`Visible` int(1) NOT NULL DEFAULT 1
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
		mysqli_query($conexion,$sqwwl);

		$sqwwl="INSERT INTO `cliente` (`ID`, `Nombre`, `Apellido`, `Celular`, `Correo`, `Visible`) VALUES
		(136, 'Armando', 'Mendez ', '6441205896', 'armando@gmail.com', 1);";
		mysqli_query($conexion,$sqwwl);
		
		$sqwwl="CREATE TABLE `color` (
			  `colot` varchar(10) NOT NULL);";
		mysqli_query($conexion,$sqwwl);

		$sqwwl="INSERT INTO `color` (`colot`) VALUES
('dc3545');";
		mysqli_query($conexion,$sqwwl);

		$sqwwl="CREATE TABLE `idpiezas` (
			`ID` int(6) NOT NULL,
			`Pieza` int(6) NOT NULL,
			`Proveedor` int(6) NOT NULL,
			`CostoC` int(11) NOT NULL,
			`CostoP` int(11) NOT NULL);";
		mysqli_query($conexion,$sqwwl);

		$sqwwl="INSERT INTO `idpiezas` (`ID`, `Pieza`, `Proveedor`, `CostoC`, `CostoP`) VALUES
		(1, 1002, 26, 10, 6),
		(2, 1003, 26, 15, 10),
		(3, 1006, 27, 10, 5),
		(4, 1002, 27, 7, 5),
		(5, 1005, 27, 0, 0);";
		mysqli_query($conexion,$sqwwl);

		$sqwwl="CREATE TABLE `idtrabajo` (
			`ID` int(6) NOT NULL,
			`Vehiculo` int(6) NOT NULL,
			`Fecha` datetime NOT NULL DEFAULT current_timestamp(),
			`Estado` int(1) NOT NULL DEFAULT 2)";
		  mysqli_query($conexion,$sqwwl);
  
		  $sqwwl="INSERT INTO `idtrabajo` (`ID`, `Vehiculo`, `Fecha`, `Estado`) VALUES
		  (31, 22, '2020-07-03 08:26:43', 0),
		  (32, 22, '2020-07-03 08:43:57', 0),
		  (33, 22, '2020-07-03 11:23:18', 1);";
		  mysqli_query($conexion,$sqwwl);
		  
		$sqwwl="CREATE TABLE `marca` (
			`ID` int(6) NOT NULL,
			`Nombre` varchar(50) NOT NULL,
			`Visible` int(1) NOT NULL DEFAULT 1);";
		  mysqli_query($conexion,$sqwwl);
  
		  $sqwwl="INSERT INTO `marca` (`ID`, `Nombre`, `Visible`) VALUES
		  (22, 'BMW', 1);";
		  mysqli_query($conexion,$sqwwl);
		  
		  $sqwwl="CREATE TABLE `modelo` (
			`ID` int(6) NOT NULL,
			`Marca` int(6) NOT NULL,
			`Nombre` varchar(40) NOT NULL,
			`Visible` int(1) NOT NULL DEFAULT 1);";
			mysqli_query($conexion,$sqwwl);
	
			$sqwwl="INSERT INTO `modelo` (`ID`, `Marca`, `Nombre`, `Visible`) VALUES
			(40, 22, 'M1', 1);";
			mysqli_query($conexion,$sqwwl);	

			$sqwwl="CREATE TABLE `pedido` (
					`ID` int(6) NOT NULL,
					`Proveedor` int(6) NOT NULL,
					`Pieza` int(6) NOT NULL,
					`Cantidad` int(11) NOT NULL,
					`Costo` double NOT NULL,
					`Estado` int(1) NOT NULL DEFAULT 1);";
			  mysqli_query($conexion,$sqwwl);
	  
			  $sqwwl="INSERT INTO `pedido` (`ID`, `Proveedor`, `Pieza`, `Cantidad`, `Costo`, `Estado`) VALUES
			  (20, 26, 1002, 6, 36, 0),
			  (21, 26, 1003, 10, 100, 0),
			  (22, 26, 1002, 50, 300, 0),
			  (23, 27, 1006, 30, 150, 0);";
			  mysqli_query($conexion,$sqwwl);

			  $sqwwl="CREATE TABLE `piezas` (
				`ID` int(6) NOT NULL,
				`Nombre` varchar(40) NOT NULL,
				`Visible` int(1) NOT NULL DEFAULT 1,
				`Existencia` int(11) NOT NULL DEFAULT 0);";
				mysqli_query($conexion,$sqwwl);
		
				$sqwwl="INSERT INTO `piezas` (`ID`, `Nombre`, `Visible`, `Existencia`) VALUES
				(1002, 'Tornillo 3/8', 0, 85),
				(1003, 'Camara V', 0, 1),
				(1004, 'N/A', 2, 0),
				(1005, 'Tornillo 6/7', 0, 10),
				(1006, 'Tornillo 1/2', 1, 20);";
				mysqli_query($conexion,$sqwwl);

				$sqwwl="CREATE TABLE `piezasser` (
					`ID` int(11) NOT NULL,
					`Trabajo` int(11) NOT NULL,
					`Piezas` int(11) NOT NULL,
					`Cantidad` int(11) NOT NULL)";
				  mysqli_query($conexion,$sqwwl);
		  
				  $sqwwl="INSERT INTO `piezasser` (`ID`, `Trabajo`, `Piezas`, `Cantidad`) VALUES
				  (21, 61, 1002, 30),
				  (24, 65, 1002, 20),
				  (25, 67, 1006, 5),
				  (26, 67, 1006, 5);";
				  mysqli_query($conexion,$sqwwl);

				  $sqwwl="CREATE TABLE `proveedor` (
					`ID` int(6) NOT NULL,
					`Empresa` varchar(50) NOT NULL,
					`Nombre` varchar(20) NOT NULL,
					`Apellido` varchar(20) NOT NULL,
					`Celular` varchar(20) NOT NULL,
					`Visible` int(1) NOT NULL DEFAULT 1);";
					mysqli_query($conexion,$sqwwl);
			
					$sqwwl="INSERT INTO `proveedor` (`ID`, `Empresa`, `Nombre`, `Apellido`, `Celular`, `Visible`) VALUES
					(26, 'HHH', 'Alan', 'Armenta', '6441659832', 1),
					(27, 'HBK', 'Armando', 'Mendez', '6441898756', 1);";
					mysqli_query($conexion,$sqwwl);

					$sqwwl="CREATE TABLE `servicio` (
						`ID` int(6) NOT NULL,
						`Nombre` varchar(50) NOT NULL,
						`Costo` double NOT NULL,
						`Visible` int(1) NOT NULL DEFAULT 1);";
					  mysqli_query($conexion,$sqwwl);
			  
					  $sqwwl="INSERT INTO `servicio` (`ID`, `Nombre`, `Costo`, `Visible`) VALUES
					  (12, 'Cambio de Aceite', 800, 1),
					  (13, 'Ajuste de amortiguadores', 600, 1),
					  (14, 'Chequeo de Frenos', 350, 1);";
					  mysqli_query($conexion,$sqwwl);

					  $sqwwl="CREATE TABLE `trabajo` (
						`ID` int(6) NOT NULL,
						`Trabajo` int(6) NOT NULL,
						`Servicio` int(6) NOT NULL,
						`Vehiculo` int(6) NOT NULL,
						`CostoT` int(6) NOT NULL,
						`Estado` int(1) NOT NULL DEFAULT 2);";
						mysqli_query($conexion,$sqwwl);
				
						$sqwwl="INSERT INTO `trabajo` (`ID`, `Trabajo`, `Servicio`, `Vehiculo`, `CostoT`, `Estado`) VALUES
						(64, 31, 12, 22, 800, 2),
						(65, 32, 12, 22, 800, 2),
						(66, 33, 13, 22, 600, 2),
						(67, 33, 14, 22, 350, 2);";
						mysqli_query($conexion,$sqwwl);

						$sqwwl="CREATE TABLE `usuario` (
								`ID` int(11) NOT NULL,
								`Nombre` varchar(50) NOT NULL,
								`Contraseña` varchar(50) NOT NULL,
								`tr` int(1) NOT NULL DEFAULT 1);";
						  mysqli_query($conexion,$sqwwl);
				  
						  $sqwwl="INSERT INTO `usuario` (`ID`, `Nombre`, `Contraseña`, `tr`) VALUES
						  (1, 'Netokingpo', 'neto2210', 1);";
						  mysqli_query($conexion,$sqwwl);
  
						  $sqwwl="CREATE TABLE `vehiculo` (
							`ID` int(6) NOT NULL,
							`Cliente` int(6) NOT NULL,
							`Marca` int(6) NOT NULL,
							`Modelo` int(6) NOT NULL,
							`Año` int(4) NOT NULL,
							`Estado` int(1) NOT NULL DEFAULT 1);";
							mysqli_query($conexion,$sqwwl);
					
							$sqwwl="INSERT INTO `vehiculo` (`ID`, `Cliente`, `Marca`, `Modelo`, `Año`, `Estado`) VALUES
							(22, 136, 22, 40, 2016, 1);";
							mysqli_query($conexion,$sqwwl);
					
							$sqwwl="ALTER TABLE `cliente`
							ADD PRIMARY KEY (`ID`),
							ADD UNIQUE KEY `Celular` (`Celular`) USING BTREE;";	
											
							$sqwwl="ALTER TABLE `idpiezas`
							ADD PRIMARY KEY (`ID`);";
							
							$sqwwl="ALTER TABLE `idtrabajo`
							ADD PRIMARY KEY (`ID`);";
							mysqli_query($conexion,$sqwwl);
							
							$sqwwl="ALTER TABLE `marca`
							ADD PRIMARY KEY (`ID`),
							ADD UNIQUE KEY `Nombre` (`Nombre`);";
							mysqli_query($conexion,$sqwwl);
							
							$sqwwl="ALTER TABLE `modelo`
							ADD PRIMARY KEY (`ID`),
							ADD UNIQUE KEY `Nombre` (`Nombre`),
							ADD KEY `Marca` (`Marca`);";
							mysqli_query($conexion,$sqwwl);
							
							$sqwwl="ALTER TABLE `pedido`
							ADD PRIMARY KEY (`ID`);";
							mysqli_query($conexion,$sqwwl);
											
							$sqwwl="ALTER TABLE `piezas`
							ADD PRIMARY KEY (`ID`),
							ADD UNIQUE KEY `Nombre` (`Nombre`);";
							mysqli_query($conexion,$sqwwl);
							
							$sqwwl="ALTER TABLE `piezasser`
							ADD PRIMARY KEY (`ID`);";
							mysqli_query($conexion,$sqwwl);		

							$sqwwl="ALTER TABLE `proveedor`
									ADD PRIMARY KEY (`ID`),
									ADD UNIQUE KEY `Empresa` (`Empresa`),
									ADD UNIQUE KEY `Celular` (`Celular`);";
							mysqli_query($conexion,$sqwwl);			

							$sqwwl="ALTER TABLE `servicio`
							ADD PRIMARY KEY (`ID`),
							ADD UNIQUE KEY `Nombre` (`Nombre`);";
							mysqli_query($conexion,$sqwwl);		

							$sqwwl="ALTER TABLE `trabajo`
							ADD PRIMARY KEY (`ID`);";
							mysqli_query($conexion,$sqwwl);

							$sqwwl="ALTER TABLE `usuario`
  									ADD PRIMARY KEY (`ID`);";
							mysqli_query($conexion,$sqwwl);			

							$sqwwl="ALTER TABLE `vehiculo`
							ADD PRIMARY KEY (`ID`),
							ADD KEY `Cliente` (`Cliente`),
							ADD KEY `Marca` (`Marca`),
							ADD KEY `Modelo` (`Modelo`);";
							mysqli_query($conexion,$sqwwl);		

							$sqwwl="ALTER TABLE `cliente`
							MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;";
							mysqli_query($conexion,$sqwwl);

							$sqwwl="ALTER TABLE `idpiezas`
  							MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;";
							mysqli_query($conexion,$sqwwl);		

							$sqwwl="ALTER TABLE `idtrabajo`
							MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;";
							mysqli_query($conexion,$sqwwl);
							
							$sqwwl="ALTER TABLE `marca`
							MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;";
							mysqli_query($conexion,$sqwwl);

							$sqwwl="ALTER TABLE `modelo`
							MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;";
							mysqli_query($conexion,$sqwwl);		

							$sqwwl="ALTER TABLE `pedido`
							MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;";
							mysqli_query($conexion,$sqwwl);

							$sqwwl="ALTER TABLE `piezas`
 						 	MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;";
							mysqli_query($conexion,$sqwwl);		

							$sqwwl="ALTER TABLE `piezasser`
							MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;";
							mysqli_query($conexion,$sqwwl);

							$sqwwl="ALTER TABLE `proveedor`
  							MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;";
							mysqli_query($conexion,$sqwwl);		

							$sqwwl="ALTER TABLE `servicio`
							MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;";
							mysqli_query($conexion,$sqwwl);
							
							$sqwwl="ALTER TABLE `trabajo`
							MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;";
							mysqli_query($conexion,$sqwwl);
							
							$sqwwl="ALTER TABLE `usuario`
							MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";
							mysqli_query($conexion,$sqwwl);
							
							$sqwwl="ALTER TABLE `vehiculo`
							MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
						  	COMMIT;";
							mysqli_query($conexion,$sqwwl);						
							$sqwwl="ALTER TABLE `color`
  ADD PRIMARY KEY (`colot`);";
							mysqli_query($conexion,$sqwwl);	


		return 1;
	}

}

?>