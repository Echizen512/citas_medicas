<?php
session_start();
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('Location: ../login.php');
    exit();
}

include_once('../view/config/dbconect.php');
$database = new Connection();
$db = $database->open();

// Obtener ID del paciente desde la URL
$id_paciente = $_GET['codpaci'] ?? null;

try {
    // Obtener la historia médica del paciente
    $stmt = $db->prepare('SELECT * FROM historia_medica_normal WHERE id_paciente = ?');
    $stmt->execute([$id_paciente]);
    $historia = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$historia) {
        echo "<div class='container mt-5'><div class='alert alert-warning' role='alert'><i class='fas fa-exclamation-triangle'></i> No se encontró una historia médica para este paciente.</div></div>";
        exit();
    }
} catch (PDOException $e) {
    echo "<div class='container mt-5'><div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Error: " . htmlspecialchars($e->getMessage()) . "</div></div>";
    exit();
}

function formatDate($date) {
    return date('d/m/Y', strtotime($date));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Historia Médica</title>
    <!-- Estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos de Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('./2312616.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            padding: 20px;
        }
        .card-custom {
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            border: 1px solid #dee2e6;
            background: rgba(255, 255, 255, 0.8); /* Fondo blanco semi-transparente para mejorar la legibilidad */
        }
        .card-header {
            background: linear-gradient(135deg, #007bff 0%, #00d2d3 100%);
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            font-size: 1.25rem;
        }
        .card-body {
            padding: 20px;
        }
        .card-body p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }
        .card-footer {
            background-color: #f8f9fa;
            border-radius: 0 0 10px 10px;
            padding: 15px;
        }
        .btn-custom {
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .icon-custom {
            color: #007bff;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card card-custom">
        <div class="card-header">
            <i class="fas fa-file-medical icon-custom"></i> Historia Médica del Paciente
        </div>
        <div class="card-body">
            <p><i class="fas fa-calendar-day icon-custom"></i> <strong>Fecha:</strong> <?php echo formatDate(htmlspecialchars($historia['fecha'])); ?></p>
            <p><i class="fas fa-user-md icon-custom"></i> <strong>Nombre de la Madre:</strong> <?php echo htmlspecialchars($historia['nombre_madre']); ?></p>
            <p><i class="fas fa-user-tie icon-custom"></i> <strong>Nombre del Padre:</strong> <?php echo htmlspecialchars($historia['nombre_padre']); ?></p>
            <p><i class="fas fa-birthday-cake icon-custom"></i> <strong>Fecha de Nacimiento:</strong> <?php echo formatDate(htmlspecialchars($historia['fecha_nacimiento'])); ?></p>
            <p><i class="fas fa-weight-hanging icon-custom"></i> <strong>Peso:</strong> <?php echo htmlspecialchars($historia['peso']); ?> kg</p>
            <p><i class="fas fa-ruler-vertical icon-custom"></i> <strong>Talla:</strong> <?php echo htmlspecialchars($historia['talla']); ?> cm</p>
            <p><i class="fas fa-stethoscope icon-custom"></i> <strong>Perímetro Cefálico:</strong> <?php echo htmlspecialchars($historia['perimetro_cefalico']); ?> cm</p>
            <p><i class="fas fa-home icon-custom"></i> <strong>Dirección:</strong> <?php echo htmlspecialchars($historia['direccion']); ?></p>
            <p><i class="fas fa-phone icon-custom"></i> <strong>Teléfono:</strong> <?php echo htmlspecialchars($historia['telefono']); ?></p>
            <p><i class="fas fa-thermometer-half icon-custom"></i> <strong>Temperatura:</strong> <?php echo htmlspecialchars($historia['temperatura']); ?> °C</p>
            <p><i class="fas fa-heartbeat icon-custom"></i> <strong>Saturación de Oxígeno:</strong> <?php echo htmlspecialchars($historia['saturacion_oxigeno']); ?> %</p>
            <p><i class="fas fa-heartbeat icon-custom"></i> <strong>Pulso:</strong> <?php echo htmlspecialchars($historia['pulso']); ?> lpm</p>
            <p><i class="fas fa-tint icon-custom"></i> <strong>Presión Arterial:</strong> <?php echo htmlspecialchars($historia['presion_arterial']); ?> mmHg</p>
            <p><i class="fas fa-lungs icon-custom"></i> <strong>Respiración:</strong> <?php echo htmlspecialchars($historia['respiracion']); ?> rpm</p>
            <p><i class="fas fa-users icon-custom"></i> <strong>Antecedentes Familiares:</strong> <?php echo htmlspecialchars($historia['antecedentes_familiares']); ?></p>
            <p><i class="fas fa-medkit icon-custom"></i> <strong>Antecedentes Personales:</strong> <?php echo htmlspecialchars($historia['antecedentes_personales']); ?></p>
            <p><i class="fas fa-eye icon-custom"></i> <strong>Examen de Ojos:</strong> <?php echo htmlspecialchars($historia['examen_ojos']); ?></p>
            <p><i class="fas fa-smile icon-custom"></i> <strong>Examen de Nariz:</strong> <?php echo htmlspecialchars($historia['examen_nariz']); ?></p>
            <p><i class="fas fa-smile-beam icon-custom"></i> <strong>Examen de Oídos:</strong> <?php echo htmlspecialchars($historia['examen_oidos']); ?></p>
            <p><i class="fas fa-smile-beam icon-custom"></i> <strong>Examen de Boca:</strong> <?php echo htmlspecialchars($historia['examen_boca']); ?></p>
            <p><i class="fas fa-cogs icon-custom"></i> <strong>Examen de Cuello:</strong> <?php echo htmlspecialchars($historia['examen_cuello']); ?></p>
            <p><i class="fas fa-smile-beam icon-custom"></i> <strong>Examen de Tórax:</strong> <?php echo htmlspecialchars($historia['examen_torax']); ?></p>
            <p><i class="fas fa-heart icon-custom"></i> <strong>Examen de Corazón:</strong> <?php echo htmlspecialchars($historia['examen_corazon']); ?></p>
            <p><i class="fas fa-lungs icon-custom"></i> <strong>Examen de Pulmones:</strong> <?php echo htmlspecialchars($historia['examen_pulmones']); ?></p>
            <p><i class="fas fa-archive icon-custom"></i> <strong>Examen de Abdomen:</strong> <?php echo htmlspecialchars($historia['examen_abdomen']); ?></p>
            <p><i class="fas fa-male icon-custom"></i> <strong>Examen de Genitales:</strong> <?php echo htmlspecialchars($historia['examen_genitales']); ?></p>
            <p><i class="fas fa-balance-scale icon-custom"></i> <strong>Examen de Articulaciones:</strong> <?php echo htmlspecialchars($historia['examen_articulaciones']); ?></p>
            <p><i class="fas fa-notes-medical icon-custom"></i> <strong>Diagnóstico y Tratamiento:</strong> <?php echo htmlspecialchars($historia['diagnostico_tratamiento']); ?></p>
        </div>
        <div class="card-footer text-center">
            <a href="./customers.php" class="btn btn-secondary btn-custom"><i class="fas fa-arrow-left"></i> Volver</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
