<?php
require_once '../../assets/fpdf/fpdf.php';

class dbConexion {
    private $dbhost = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "consultorio";

    public function getConexion() {
        $con = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname);
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $con;
    }
}

$codcit = isset($_GET['codcit']) ? $_GET['codcit'] : die("Cita no especificada.");
$db = new dbConexion();
$conn = $db->getConexion();

// Obtener datos del pago
$query = "SELECT p.*, c.nombrep, c.apellidop, c.dnipa, c.tele 
          FROM pagos p
          JOIN customers c ON p.codpaci = c.codpaci
          WHERE p.codcit = '$codcit'";

$result = mysqli_query($conn, $query);
$pago = mysqli_fetch_assoc($result);

if (!$pago) {
    die("No se encontró un pago para esta cita.");
}

class PDF extends FPDF {
    function Header() {
        $this->Image('../../assets/img/logo.jpg', 10, 10, 40);
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(33, 37, 41);
        $this->Ln(10);
        $this->Cell(0, 10, utf8_decode('Consultorio Pediátrico Dra. Yenitze Perdomo'), 0, 1, 'C');
        $this->Cell(0, 10, 'La Victoria - Estado Aragua', 0, 1, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'FACTURA', 0, 1, 'C');
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.5);
        $this->Line(10, 55, 200, 55);
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-30);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(128, 128, 128);
        $this->Cell(0, 10, 'Gracias por su preferencia.', 0, 1, 'C');
        $this->Cell(0, 10, 'Pag ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function InvoiceDetails($pago) {
        // Configuración de colores
        $this->SetFillColor(240, 240, 240);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(0, 0, 0);

        // Datos del paciente
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 8, 'Datos del Paciente', 1, 1, 'C', true);
        $this->SetFont('Arial', '', 10);
        $this->Cell(95, 6, utf8_decode('Nombre:'), 1, 0, 'L');
        $this->Cell(95, 6, utf8_decode($pago['nombrep'] . ' ' . $pago['apellidop']), 1, 1, 'L');
        $this->Cell(95, 6, utf8_decode('Cédula:'), 1, 0, 'L');
        $this->Cell(95, 6, utf8_decode($pago['dnipa']), 1, 1, 'L');
        $this->Cell(95, 6, utf8_decode('Teléfono:'), 1, 0, 'L');
        $this->Cell(95, 6, utf8_decode($pago['tele']), 1, 1, 'L');
        $this->Ln(5);

        // Detalles del pago
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 8, 'Detalles del Pago', 1, 1, 'C', true);
        $this->SetFont('Arial', '', 10);
        $this->Cell(95, 6, utf8_decode('Método de Pago:'), 1, 0, 'L');
        $this->Cell(95, 6, utf8_decode($pago['metodo_pago']), 1, 1, 'L');
        $this->Cell(95, 6, 'Referencia:', 1, 0, 'L');
        $this->Cell(95, 6, utf8_decode($pago['referencia']), 1, 1, 'L');
        $this->Cell(95, 6, 'Monto ($):', 1, 0, 'L');
        $this->Cell(95, 6, number_format($pago['monto'], 2), 1, 1, 'L');
        $this->Cell(95, 6, 'Monto (Bs):', 1, 0, 'L');
        $this->Cell(95, 6, number_format($pago['monto_bs'], 2), 1, 1, 'L');
        $this->Cell(95, 6, 'Fecha:', 1, 0, 'L');
        $this->Cell(95, 6, utf8_decode($pago['fecha']), 1, 1, 'L');
        $this->Ln(5);

        // Totales
        $subtotal = $pago['monto'];

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 8, 'Resumen de Pago', 1, 1, 'C', true);
        $this->SetFont('Arial', '', size: 10);
        $this->Cell(95, 6, 'Total:', 1, 0, 'L');
        $this->Cell(95, 6, '$' . number_format($subtotal, 2), 1, 1, 'L');
        $this->Ln(10);


    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->InvoiceDetails($pago);
$pdf->Output('factura.pdf', 'I');
?>
