<?php
    session_start();
    include_once('../config/dbconect.php');

    if(isset($_POST['editar'])){
        $database = new Connection();
        $db = $database->open();
        try{
            $codpaci  = $_GET['codpaci'];
            $dnipa = $_POST['dnipa'];
            $nombrep = $_POST['nombrep'];
            $apellidop = $_POST['apellidop'];
            $seguro = $_POST['seguro'];
            $tele = $_POST['tele'];
            $sexo = $_POST['sexo'];
			$usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
			
            if (!empty($clave)) {
                $hashed_password = password_hash($clave, PASSWORD_DEFAULT);

                $sql = "UPDATE customers SET dnipa = '$dnipa', nombrep = '$nombrep', apellidop = '$apellidop', seguro = '$seguro', tele = '$tele', sexo = '$sexo', usuario = '$usuario', clave = '$hashed_password', fecha_nacimiento = '$fecha_nacimiento' WHERE codpaci = '$codpaci'";
            } else {
                $sql = "UPDATE customers SET dnipa = '$dnipa', nombrep = '$nombrep', apellidop = '$apellidop', seguro = '$seguro', tele = '$tele', sexo = '$sexo', usuario = '$usuario', fecha_nacimiento = '$fecha_nacimiento' WHERE codpaci = '$codpaci'";
            }

            $_SESSION['message'] = ( $db->exec($sql) ) ? 'Paciente actualizado correctamente' : 'No se pudo actualizar el paciente';

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
