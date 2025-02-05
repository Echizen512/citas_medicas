<?php
	session_start();
	include_once('../config/dbconect.php');

	if(isset($_POST['editar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$codpaci  = $_GET['codpaci'];
			
			$clave = MD5($_POST['clave']);
			
			$sql = "UPDATE customers SET clave = '$clave'  WHERE codpaci = '$codpaci'";
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Contraseña actualizada correctamente' : 'No se puso actualizar la contraseña';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		$database->close();
	}
	else{
		$_SESSION['message'] = 'Complete el formulario de edición';
	}

	header('location: ../../folder/customers.php');

?>