<?php
	session_start();
	include_once('../controlador/connection.php');

	if(isset($_POST['edit'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$direccion = $_POST['direccion'];

			$sql = "UPDATE clientes SET nombre = '$nombre', apellido = '$apellido', direccion = '$direccion' WHERE id = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Cliente actualizado correctamente' : 'Nose modifico el cliente. No se pudo actualizar';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Fill up edit form first';
	}

	header('location: index.php');

?>