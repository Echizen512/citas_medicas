<?php
include_once('../view/config/dbconect.php');
$database = new Connection();
$db = $database->open();

if (isset($_GET['codpaci'])) {
    $codpaci = $_GET['codpaci'];

    $stmt = $db->prepare('SELECT fecha_nacimiento FROM customers WHERE codpaci = ?');
    $stmt->execute([$codpaci]);
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

    function calcularEdad($fechaNacimiento) {
        $fechaActual = new DateTime();
        $fechaNacimiento = new DateTime($fechaNacimiento);
        $edad = $fechaActual->diff($fechaNacimiento);
        return $edad->y;
    }

    if ($paciente) {
        $edad = calcularEdad($paciente['fecha_nacimiento']);
        $historia_existente = $paciente['historia_existente'];

            if ($edad < 1) {
                header('Location: Historia.php?codpaci=' . $codpaci);
                exit;
            } else {
                header('Location: Historia.php?codpaci=' . $codpaci);
                exit;
            }
        }
    } else {
        echo '<script>
                Swal.fire({
                    title: "Error",
                    text: "Paciente no encontrado.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
              </script>';
    }

    $database->close();

?>