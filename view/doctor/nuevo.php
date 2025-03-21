<?php
	session_start();
	include_once('../config/dbconect.php');
	if(isset($_POST['agregar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$stmt = $db->prepare("INSERT INTO doctor (dnidoc, nomdoc,apedoc,codespe,sexo,telefo,fechanaci,correo ,naciona,estado) VALUES (:dnidoc, :nomdoc, :apedoc, :codespe, :sexo,:telefo,:fechanaci,:correo,:naciona,:estado)");
			$_SESSION['message'] = ( $stmt->execute(array(':dnidoc' => $_POST['dnidoc'] , ':nomdoc' => $_POST['nomdoc'] , ':apedoc' => $_POST['apedoc'], ':codespe' => $_POST['codespe'], ':sexo' => $_POST['sexo'], ':telefo' => $_POST['telefo'], ':fechanaci' => $_POST['fechanaci'], ':correo' => $_POST['correo'], ':naciona' => $_POST['naciona'], ':estado' => $_POST['estado'])) ) ? 'Paciente guardado correctamente' : 'Algo salió mal. No se puede agregar miembro';		
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Llene el formulario';
	}
	header('location: ../../folder/doctor.php');
?>