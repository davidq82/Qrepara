<?php
	session_start();
	include_once('../controlador/connection.php');

	if(isset($_GET['id'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM clientes WHERE id = '".$_GET['id']."'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Cliente eliminado' : 'No se pudo eliminar el cliente';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Seleccionar el cliente a eliminar';
	}

	header('location: index.php');

?>