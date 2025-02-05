<?php
include "../config/conex.php";

header("Content-Type: application/json"); // Definir respuesta como JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codcit = $_POST['codcit'];
    $codpaci = $_POST['codpaci'];
    $coddoc = $_POST['coddoc'];
    $monto = $_POST['monto'];
    $monto_bs = $_POST['monto_bs'];
    $metodo_pago = $_POST['metodo_pago'];
    $referencia = $_POST['referencia'];

    $sql = "INSERT INTO pagos (codcit, codpaci, coddoc, monto, monto_bs, metodo_pago, referencia) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conex, $sql);
    mysqli_stmt_bind_param($stmt, "iiiddis", $codcit, $codpaci, $coddoc, $monto, $monto_bs, $metodo_pago, $referencia);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Pago registrado correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "No se pudo registrar el pago"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}
?>
