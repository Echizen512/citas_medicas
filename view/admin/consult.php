<?php
	require_once "../config/conexion1.php";
		$sql_citas_diarias = "SELECT DATE(fecha_create) AS fecha, COUNT(*) AS total FROM appointment GROUP BY DATE(fecha_create)";
		$result_citas_diarias = $bd->query($sql_citas_diarias);
		$citas_diarias = $result_citas_diarias->fetchAll(PDO::FETCH_ASSOC);
											
		$sql_pacientes = "SELECT COUNT(*) total FROM customers";
		$result_pacientes = $bd->query($sql_pacientes);
		$total_pacientes = $result_pacientes->fetchColumn();

		$sql_doctores = "SELECT COUNT(*) total FROM doctor";
		$result_doctores = $bd->query($sql_doctores);
		$total_doctores = $result_doctores->fetchColumn();

		$sql_citas = "SELECT COUNT(*) total FROM appointment";
		$result_citas = $bd->query($sql_citas);
		$total_citas = $result_citas->fetchColumn();
	?>