<?php
ob_start(); 

class dbConexion {
    private $dbhost = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "consultorio";
    private $conn;

    public function getConexion() {
        $con = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname);
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $this->conn = $con;
        return $this->conn;
    }
}

include_once('../../assets/fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->Image('../../assets/img/logo.jpg', 20, 10, 45);
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(33, 37, 41);
        $this->Ln(10);
        $this->Cell(0, 5, utf8_decode('República Bolivariana de Venezuela'), 0, 1, 'C');
        $this->Ln(5); 
        $this->Cell(0, 5, utf8_decode('Consultorio Pediátrico Dra. Yenitze Perdomo'), 0, 1, 'C');
        $this->Ln(5); 
        $this->Cell(0, 5, 'La Victoria - Estado Aragua', 0, 1, 'C');
        $this->Ln(15); 
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Reporte de Pagos', 0, 1, 'C');
        $this->Ln(15); 
        $this->SetDrawColor(0, 123, 255);
        $this->SetLineWidth(1);
        $this->Line(10, 80, 280, 80); 
        $this->Ln(10); 
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function FancyTable($header, $data) {
        $this->SetFillColor(0, 123, 255);  
        $this->SetTextColor(255);         
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial', 'B', 12);

        $w = array(30, 40, 40, 40, 40, 40, 50);

        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();

        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('Arial', '', 12);

        $fill = false;
        while ($row = mysqli_fetch_assoc($data)) {
            $this->Cell($w[0], 8, utf8_decode($row['codcit'] ?? ''), 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 8, utf8_decode($row['codpaci'] ?? ''), 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 8, utf8_decode($row['monto'] ?? ''), 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 8, utf8_decode($row['monto_bs'] ?? ''), 'LR', 0, 'C', $fill);
            $metodos_pago = [
                1 => 'Pago Móvil',
                2 => 'PayPal',
                3 => 'Binance',
                4 => 'Efectivo'
            ];
            $metodo_pago = $metodos_pago[$row['metodo_pago']] ?? 'Desconocido';
            $this->Cell($w[4], 8, utf8_decode($metodo_pago), 'LR', 0, 'C', $fill);
        
            $this->Cell($w[5], 8, utf8_decode($row['referencia'] ?? ''), 'LR', 0, 'C', $fill);
            $this->Cell($w[6], 8, utf8_decode($row['fecha'] ?? ''), 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

        $db = new dbConexion();
        $connString = $db->getConexion();
        $display_heading = array('CITA', 'PACIENTE', 'MONTO', 'MONTO BS', 'METODO PAGO', 'REFERENCIA', 'FECHA');
        $result = mysqli_query($connString, "SELECT `codcit`, `codpaci`, `monto`, `monto_bs`, `metodo_pago`, `referencia`, `fecha` FROM `pagos`") or die("database error:" . mysqli_error($connString));

        $pdf = new PDF('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->FancyTable($display_heading, $result);

        ob_end_clean();
        $pdf->Output('D', 'pagos.pdf');

?>
