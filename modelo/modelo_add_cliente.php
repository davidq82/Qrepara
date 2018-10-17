<?php
	session_start();
	include_once('../controlador/connection.php');

	if(isset($_POST['add'])){
		$database = new Connection();
		$db = $database->open();
		try{
			//make use of prepared statement to prevent sql injection
			$stmt = $db->prepare("INSERT INTO clientes (nombre, apellido, direccion) VALUES (:nombre, :apellido, :direccion)");
			//if-else statement in executing our prepared statement
			$_SESSION['message'] = ( $stmt->execute(array(':nombre' => $_POST['nombre'] , ':apellido' => $_POST['apellido'] , ':direccion' => $_POST['direccion'])) ) ? 'Cliente agregado correctamente' : 'No se pudo agregar el cliente';	
	    
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();
	}

	else{
		$_SESSION['message'] = 'Fill up add form first';
	}

	header('location: index.php');
	
?>