<?php
session_start();
include_once('../config/dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		
		$stmt = $db->prepare("INSERT INTO appointment (dates, hour,codpaci,coddoc,codespe,estado) VALUES (:dates, :hour, :codpaci, :coddoc, :codespe,:estado)");
		
		$_SESSION['message'] = ( $stmt->execute(array(':dates' => $_POST['dates'] , ':hour' => $_POST['hour'] , ':codpaci' => $_POST['codpaci'], ':coddoc' => $_POST['coddoc'], ':codespe' => $_POST['codespe'], ':estado' => $_POST['estado'])) ) ? 'Cita guardada correctamente' : 'Algo salió mal. No se puede agregar miembro';	
	
	}
	catch(PDOException $e){
		$_SESSION['message'] = $e->getMessage();
	}

	$database->close();
}

else{
	$_SESSION['message'] = 'Llene el formulario';
}

header('location: ../../folder/appointment.php');
	
?>