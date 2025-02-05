<?php
require('fpdf.php'); // Incluimos la biblioteca FPDF

// Función para generar el PDF
function generarFactura($id_cita) {
    // Conexión a la base de datos (ajusta tus credenciales)
    $servername = "tu_servidor";
    $username = "tu_usuario";
    $password = "tu_contrasena";
    $dbname = "tu_base_de_datos";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Obtener los datos de la cita y los insumos desde la base de datos
    $sql = "SELECT c.*, p.*, i.* FROM cita c
            INNER JOIN paciente p ON c.id_paciente = p.id_paciente
            INNER JOIN insumo i ON c.id_cita = i.id_cita
            WHERE c.id_cita = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_cita);
    $stmt->execute();
    $result = $stmt->get_result();

    // Crear un nuevo objeto PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Factura', 1, 0, 'C');

    // Agregar los datos de la factura al PDF
    while ($row = $result->fetch_assoc()) {
        $pdf->Ln();
        $pdf->Cell(0, 10, "Paciente: " . $row['nombre'] . " " . $row['apellido'], 0, 1);
        $pdf->Cell(0, 10, "Fecha: " . $row['fecha'], 0, 1);
        // ... Agregar más datos de la factura ...

        // Agregar los insumos a la factura
        $pdf->Cell(0, 10, "Insumos:", 0, 1);
        $pdf->Cell(40, 10, 'Nombre', 1, 0);
        $pdf->Cell(40, 10, 'Cantidad', 1, 0);
        $pdf->Cell(40, 10, 'Precio', 1, 1);
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(40, 10, $row['nombre_insumo'], 1, 0);
            $pdf->Cell(40, 10, $row['cantidad'], 1, 0);
            $pdf->Cell(40, 10, $row['precio'], 1, 1);
        }

        // Agregar el total de la factura
        // ...

    }

    $pdf->Output();
    $stmt->close();
    $conn->close();
}

// Ejemplo de cómo llamar a la función
generarFactura(123); // Reemplaza 123 con el ID de la cita