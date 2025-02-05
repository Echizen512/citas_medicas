<?php
session_start();
include_once('../config/dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		
		$stmt = $db->prepare("INSERT INTO specialty (nombrees) VALUES (:nombrees)");
		
		$_SESSION['message'] = ( $stmt->execute(array(':nombrees' => $_POST['nombrees'])) ) ? 'Guardado correctamente' : 'Algo salió mal. No se puede agregar';	
	
	}
	catch(PDOException $e){
		$_SESSION['message'] = $e->getMessage();
	}


	$database->close();
}

else{
	$_SESSION['message'] = 'Llene el formulario';
}

header('location: ../../folder/specialty.php');
	
?>