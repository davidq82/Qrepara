<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lamsys Reparaciones</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1 class="page-header text-center">Clientes</h1>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Nuevo</a>
            <?php 
                session_start();
                if(isset($_SESSION['message'])){
                    ?>
                    <div class="alert alert-info text-center" style="margin-top:20px;">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php

                    unset($_SESSION['message']);
                }
            ?>
			<table class="table table-bordered table-striped" style="margin-top:20px;">
				<thead>
					<th>ID</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Direccion</th>
					<th>Accion</th>
				</thead>
				<tbody>
					<?php
						//include our connection
						include_once('controlador/connection.php');

						$database = new Connection();
    					$db = $database->open();
						try{	
						    $sql = 'SELECT * FROM clientes';
						    foreach ($db->query($sql) as $row) {
						    	?>
						    	<tr>
						    		<td><?php echo $row['id']; ?></td>
						    		<td><?php echo $row['nombre']; ?></td>
						    		<td><?php echo $row['apellido']; ?></td>
						    		<td><?php echo $row['direccion']; ?></td>
						    		<td>
						    			<a href="#edit_<?php echo $row['id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Editar</a>
						    			<a href="#delete_<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Borrar</a>
						    		</td>
						    	</tr>
						    	<?php 
						    }
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						//close connection
						$database->close();
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>


</body>
</html>

<?php include('vista/vista_delete_cliente.php'); ?>
<?php include('vista/vista_edit_cliente.php'); ?>
<?php include('vista/vista_add_cliente.php'); ?>



<script src="jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
