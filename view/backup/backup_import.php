<?php
session_start();
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('location: ../login.php');
    exit();
}

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "consultorio";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Conexión fallida: " . $conn->connect_error]));
}

$backup_dir = getenv("HOMEDRIVE") . getenv("HOMEPATH") . "\\Desktop\\respaldos\\";
if (!file_exists($backup_dir)) {
    mkdir($backup_dir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'backup') {
        $backup_file = $backup_dir . $dbname . "_" . date("Y-m-d-H-i-s") . ".sql";

        $tables = [];
        $result = $conn->query("SHOW TABLES");
        while ($row = $result->fetch_row()) {
            $tables[] = $row[0];
        }

        $sqlScript = "";
        foreach ($tables as $table) {
            $row2 = $conn->query("SHOW CREATE TABLE $table")->fetch_row();
            $sqlScript .= "DROP TABLE IF EXISTS `$table`;\n" . $row2[1] . ";\n\n";

            $result = $conn->query("SELECT * FROM `$table`");
            while ($row = $result->fetch_assoc()) {
                $values = array_map(function ($val) use ($conn) {
                    return $val !== null ? "'" . $conn->real_escape_string($val) . "'" : "NULL";
                }, array_values($row));
                $sqlScript .= "INSERT INTO `$table` VALUES (" . implode(",", $values) . ");\n";
            }
            $sqlScript .= "\n";
        }

        file_put_contents($backup_file, $sqlScript);
        echo json_encode(["status" => "success", "message" => "Respaldo creado exitosamente.", "file" => $backup_file]);
        exit();
    }

    if (isset($_POST['action']) && $_POST['action'] === 'import' && isset($_FILES['backup_file'])) {
        $file = $_FILES['backup_file'];

        if ($file['type'] !== 'application/octet-stream' && pathinfo($file['name'], PATHINFO_EXTENSION) !== 'sql') {
            echo json_encode(["status" => "error", "message" => "Archivo inválido. Debe ser un archivo .sql"]);
            exit();
        }

        $sqlScript = file_get_contents($file['tmp_name']);
        $commands = explode(';', $sqlScript);
        foreach ($commands as $command) {
            if (trim($command)) {
                $conn->query($command);
            }
        }

        echo json_encode(["status" => "success", "message" => "Respaldo importado exitosamente."]);
        exit();
    }
}

$conn->close();
?>
