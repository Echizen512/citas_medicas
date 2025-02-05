<?php
session_start();
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('Location: ../login.php');
    exit();
}

include_once('../view/config/dbconect.php');
$database = new Connection();
$db = $database->open();

$id_paciente = $_GET['codpaci'] ?? null;

if (!$id_paciente) {
    die('Error: No se proporcionó un código de paciente válido.');
}

try {
    $checkStmt = $db->prepare('SELECT COUNT(*) FROM historia_medica_normal WHERE id_paciente = ?');
    $checkStmt->execute([$id_paciente]);
    $exists = $checkStmt->fetchColumn();

    if ($exists) {
        header('Location: ./Ver_Historia.php?codpaci=' . urlencode($id_paciente));
        exit();
    }
} catch (PDOException $e) {
    die('Error al verificar la historia médica: ' . htmlspecialchars($e->getMessage()));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields = [
        'fecha',
        'nombre_madre',
        'nombre_padre',
        'fecha_nacimiento',
        'peso',
        'talla',
        'perimetro_cefalico',
        'direccion',
        'telefono',
        'temperatura',
        'saturacion_oxigeno',
        'pulso',
        'presion_arterial',
        'respiracion',
        'antecedentes_familiares',
        'antecedentes_personales',
        'examen_ojos',
        'examen_nariz',
        'examen_oidos',
        'examen_boca',
        'examen_cuello',
        'examen_torax',
        'examen_corazon',
        'examen_pulmones',
        'examen_abdomen',
        'examen_genitales',
        'examen_articulaciones',
        'diagnostico_tratamiento',
    ];

    $data = [];
    foreach ($fields as $field) {
        $data[$field] = $_POST[$field] ?? null;
    }

    // Agregar el id_paciente a los datos
    $data['id_paciente'] = $id_paciente;

    // Debug: Ver los datos que estamos a punto de insertar
    echo '<pre>';
    echo 'Datos a insertar:';
    print_r($data); // Muestra el array de datos
    echo '</pre>';

    // Aseguramos que hay exactamente 31 valores para los 31 marcadores de posición
    try {
        $stmt = $db->prepare(
            'INSERT INTO historia_medica_normal (fecha, nombre_madre, nombre_padre, fecha_nacimiento, peso, talla,
                    perimetro_cefalico, direccion, telefono, temperatura, saturacion_oxigeno, pulso, presion_arterial, respiracion, 
                    antecedentes_familiares, antecedentes_personales, examen_ojos, examen_nariz, examen_oidos, examen_boca, examen_cuello, 
                    examen_torax, examen_corazon, examen_pulmones, examen_abdomen, examen_genitales, examen_articulaciones,
                    diagnostico_tratamiento, id_paciente)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)'
        );


        // Debug: Mostrar la consulta SQL antes de ejecutarla
        echo '<pre>';
        echo 'Consulta SQL: ';
        var_dump($stmt->queryString); // Muestra la consulta preparada
        echo '</pre>';

        // Ejecutar la consulta con el array de datos
        $stmt->execute(array_values($data));

        // Debug: Confirmación de inserción exitosa
        echo '<pre>';
        echo 'Datos insertados correctamente.';
        echo '</pre>';

        header('Location: ./customers.php?status=success');
        exit();
    } catch (PDOException $e) {
        echo 'Error al guardar los datos: ' . htmlspecialchars($e->getMessage());
        // También muestra el error completo para depuración
        echo '<pre>';
        var_dump($e);
        echo '</pre>';
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<style>
    body {
        background: url('./2312616.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .container {
        margin-top: 400px;
    }
</style>


<body>


    <br> <br> <br>
    <div class="container my-5">
        <h3 class="text-center">Historia Médica</h3>
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="card shadow-lg w-75">
                <div class="card-header bg-primary text-white text-center">
                    <h4><i class="fas fa-notes-medical"></i> Historia Médica</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <!-- Datos básicos -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fecha" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha:</label>
                                <input type="date" name="fecha" id="fecha" class="form-control" required>
                            </div>


                            <div class="col-md-6">
                                <label for="fecha_nacimiento" class="form-label"><i class="fas fa-birthday-cake"></i>
                                    Fecha de Nacimiento:</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre_madre" class="form-label"><i class="fas fa-female"></i> Nombre de la
                                    Madre:</label>
                                <input type="text" name="nombre_madre" id="nombre_madre" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre_padre" class="form-label"><i class="fas fa-male"></i> Nombre del
                                    Padre:</label>
                                <input type="text" name="nombre_padre" id="nombre_padre" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="peso" class="form-label"><i class="fas fa-weight"></i> Peso (kg):</label>
                                <input type="number" name="peso" id="peso" class="form-control" step="0.01" required>
                            </div>
                            <div class="col-md-6">
                                <label for="talla" class="form-label"><i class="fas fa-ruler-vertical"></i> Talla
                                    (cm):</label>
                                <input type="number" name="talla" id="talla" class="form-control" step="0.01" required>
                            </div>
                        </div>
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label for="perimetro_cefalico" class="form-label"><i class="fas fa-tape"></i> Perímetro
                                    Cefálico (cm):</label>
                                <input type="number" name="perimetro_cefalico" id="perimetro_cefalico"
                                    class="form-control" step="0.01">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div> <br>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="temperatura" class="form-label"><i class="fas fa-temperature-high"></i>
                                    Temperatura (°C):</label>
                                <input type="number" name="temperatura" id="temperatura" class="form-control"
                                    step="0.1">
                            </div>
                            <div class="col-md-3">
                                <label for="saturacion_oxigeno" class="form-label"><i class="fas fa-heartbeat"></i>
                                    Oxígeno (%):</label>
                                <input type="number" name="saturacion_oxigeno" id="saturacion_oxigeno"
                                    class="form-control" step="1">
                            </div>
                            <div class="col-md-3">
                                <label for="pulso" class="form-label"><i class="fas fa-heart"></i> Pulso (ppm):</label>
                                <input type="number" name="pulso" id="pulso" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="presion_arterial" class="form-label"><i class="fas fa-stethoscope"></i>
                                    Presión Arterial:</label>
                                <input type="text" name="presion_arterial" id="presion_arterial" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="respiracion" class="form-label"><i class="fas fa-lungs"></i> Respiración
                                    (rpm):</label>
                                <input type="number" name="respiracion" id="respiracion" class="form-control">
                            </div>
                        </div>

                        <!-- Antecedentes -->
                        <div class="mb-3">
                            <label for="antecedentes_familiares" class="form-label"><i class="fas fa-users"></i>
                                Antecedentes Familiares:</label>
                            <textarea name="antecedentes_familiares" id="antecedentes_familiares" class="form-control"
                                rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="antecedentes_personales" class="form-label"><i class="fas fa-user"></i>
                                Antecedentes Personales:</label>
                            <textarea name="antecedentes_personales" id="antecedentes_personales" class="form-control"
                                rows="3" required></textarea>
                        </div>

                        <!-- Exámenes -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="examen_ojos" class="form-label"><i class="fas fa-eye"></i> Examen de
                                    Ojos:</label>
                                <input type="text" name="examen_ojos" id="examen_ojos" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="examen_nariz" class="form-label"><i class="fas fa-nose"></i> Examen de
                                    Nariz:</label>
                                <input type="text" name="examen_nariz" id="examen_nariz" class="form-control">
                            </div>
                        </div>

                        <!-- Exámenes Físicos -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="examen_oidos" class="form-label"><i class="fas fa-ear"></i> Examen de
                                    Oídos:</label>
                                <input type="text" name="examen_oidos" id="examen_oidos" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="examen_boca" class="form-label"><i class="fas fa-smile"></i> Examen de
                                    Boca:</label>
                                <input type="text" name="examen_boca" id="examen_boca" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="examen_cuello" class="form-label"><i class="fas fa-user-tie"></i> Examen de
                                    Cuello:</label>
                                <input type="text" name="examen_cuello" id="examen_cuello" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="examen_torax" class="form-label"><i class="fas fa-lungs"></i> Examen de
                                    Tórax:</label>
                                <input type="text" name="examen_torax" id="examen_torax" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="examen_corazon" class="form-label"><i class="fas fa-heartbeat"></i> Examen
                                    del Corazón:</label>
                                <input type="text" name="examen_corazon" id="examen_corazon" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="examen_pulmones" class="form-label"><i class="fas fa-lungs"></i> Examen de
                                    Pulmones:</label>
                                <input type="text" name="examen_pulmones" id="examen_pulmones" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="examen_abdomen" class="form-label"><i class="fas fa-user-md"></i> Examen de
                                    Abdomen:</label>
                                <input type="text" name="examen_abdomen" id="examen_abdomen" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="examen_genitales" class="form-label"><i class="fas fa-user"></i> Examen de
                                    Genitales:</label>
                                <input type="text" name="examen_genitales" id="examen_genitales" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="examen_articulaciones" class="form-label"><i class="fas fa-bone"></i> Examen
                                    de Articulaciones:</label>
                                <input type="text" name="examen_articulaciones" id="examen_articulaciones"
                                    class="form-control">
                            </div>
                        </div>
                        <!-- Repetir los exámenes restantes siguiendo la misma estructura -->

                        <!-- Otros datos -->
                        <div class="mb-3">
                            <label for="diagnostico_tratamiento" class="form-label"><i class="fas fa-notes-medical"></i>
                                Diagnóstico y Tratamiento:</label>
                            <textarea name="diagnostico_tratamiento" id="diagnostico_tratamiento" class="form-control"
                                rows="3"></textarea>
                        </div>
                        <input type="hidden" name="id_paciente" value="<?php echo htmlspecialchars($id_paciente); ?>" />
                        <!-- Botón -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>