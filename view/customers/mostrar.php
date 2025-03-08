<?php
session_start();
if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1){
    header('location: ../login.php');
    exit(); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_patient'])) {
    include_once('../view/config/dbconect.php');
    $database = new Connection();
    $db = $database->open();
    
    $dnipa = htmlspecialchars($_POST['dnipa']);
    $nombrep = htmlspecialchars($_POST['nombrep']);
    $apellidop = htmlspecialchars($_POST['apellidop']);
    $seguro = htmlspecialchars($_POST['seguro']);
    $tele = htmlspecialchars($_POST['tele']);
    $sexo = htmlspecialchars($_POST['sexo']);
    $cargo = htmlspecialchars($_POST['cargo']);
    $usuario = htmlspecialchars($_POST['usuario']);
    $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT); 
    $estado = 1; 
    $fecha_nacimiento = htmlspecialchars($_POST['fecha_nacimiento']);
    
    try {
        $sql = 'INSERT INTO customers (dnipa, nombrep, apellidop, seguro, tele, sexo, cargo, usuario, clave, estado, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->execute([$dnipa, $nombrep, $apellidop, $seguro, $tele, $sexo, $cargo, $usuario, $clave, $estado, $fecha_nacimiento]);
        echo '<script>
                Swal.fire({
                    title: "Paciente agregado",
                    text: "El paciente ha sido agregado correctamente.",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
              </script>';
    } catch (PDOException $e) {
        echo '<script>
                Swal.fire({
                    title: "Error",
                    text: "Hubo un problema al agregar el paciente: ' . htmlspecialchars($e->getMessage()) . '",
                    icon: "error",
                    confirmButtonText: "OK"
                });
              </script>';
    }
    $database->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Pacientes</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/atlantis.min.css">
    <link rel="stylesheet" href="../assets/css/demo.css">
</head>
<body>

<?php
	include '../Includes/Header.php';
    include '../Includes/Navbar.php';
    include '../Includes/Sidebar.php';
?>



<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pacientes</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="../view/admin/admin.php">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Mostrar</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Mostrar</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addPatientModal">Nuevo</button>
                            </div>
                            <div class="card-tools">
                                <a href="../view/customers/reporte.php" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                    <span class="btn-label">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Exportar PDF
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>DNI</th>
                                                <th>Paciente</th>
                                                <th>Seguro</th>
                                                <th>Teléfono</th>
                                                <th>Estado</th>
                                                <th>Fecha</th>
                                                <th style="width: 10%">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include_once('../view/config/dbconect.php');
                                                $database = new Connection();
                                                $db = $database->open();
                                                try {    
                                                    $sql = 'SELECT * FROM customers';
                                                    foreach ($db->query($sql) as $row) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($row['dnipa']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['nombrep']) . ' ' . htmlspecialchars($row['apellidop']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['seguro']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['tele']); ?></td>
                                                            <td>
                                                                <?php if($row['estado'] == 1) { ?> 
                                                                    <form method="get" action="javascript:activo('<?php echo htmlspecialchars($row['codpaci']); ?>')">
                                                                        <button type="submit" class="btn btn-success btn-xs">Activo</button>
                                                                    </form>
                                                                <?php } else { ?> 
                                                                    <form method="get" action="javascript:inactivo('<?php echo htmlspecialchars($row['codpaci']); ?>')"> 
                                                                        <button type="submit" class="btn btn-danger btn-xs">Inactivo</button>
                                                                    </form>
                                                                <?php } ?>                         
                                                            </td>
                                                            <td><?php echo date('d, m, Y', strtotime($row['fecha_nacimiento'])); ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <button class="btn btn-link btn-primary btn-lg" data-toggle="modal" title="Edit Task" data-target="#editRowModal<?php echo htmlspecialchars($row['codpaci']); ?>">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                    <form method="get" action="./historia_medica.php">
                                                                        <input type="hidden" name="codpaci" value="<?php echo htmlspecialchars($row['codpaci']); ?>">
                                                                        <button type="submit" class="btn btn-link btn-info btn-lg" title="Historia Médica">
                                                                            <i class="fa fa-file-medical"></i> 
                                                                        </button>
                                                                    </form>
                                                                    <?php include('editar.php'); ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php 
                                                    }
                                                } catch(PDOException $e) {
                                                    echo "Hubo un problema en la conexión: " . htmlspecialchars($e->getMessage());
                                                }
                                                $database->close();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-labelledby="addPatientModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="addPatientModalLabel">Agregar Paciente</h4>
    </div>    
	<div class="modal-body">
		<div class="container-fluid">
        <div class="card-body">
        <form method="POST">
		<div class="row">
		<div class="col-sm-12">
			<div class="form-group form-group-default">
                <label>Cédula del Representante</label>
                <input type="number" class="form-control" name="dnipa" placeholder="C.I" required>
            </div>
		</div>
		<div class="col-md-6 pr-0">
			<div class="form-group form-group-default">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombrep" placeholder="Nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+"  title="Solo se permiten letras, acentos y espacios" required>
            </div>
		</div>
		<div class="col-md-6">
			<div class="form-group form-group-default">
                <label>Apellido</label>
                <input type="text" class="form-control" name="apellidop" placeholder="Apellido" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+"  title="Solo se permiten letras, acentos y espacios" required>
            </div>
		</div>
		<div class="col-md-6">
			<div class="form-group form-group-default">
                <label>Seguro</label>
				<select class="form-control" name="seguro" required>
					<option value="Si">Si</option>
					<option value="No">No</option>
				</select>
            </div>
		</div>
        <div class="col-md-6">
			<div class="form-group form-group-default">
                <label>Teléfono</label>
                <input type="number" class="form-control" name="tele" placeholder="Teléfono" required>
            </div>
		</div>
        <div class="col-md-6">
			<div class="form-group form-group-default">
                <label>Sexo</label>
				<select class="form-control" name="sexo" required>
						<option value="Masculino">Masculino</option>
						<option value="Femenino">Femenino</option>
				</select>
            </div>
		</div>

		<div class="col-md-6">
			<div class="form-group form-group-default">
                <label>Usuario</label>
                <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
            </div>
		</div>
		<div class="col-md-6">
        <div class="form-group form-group-default">
            <label>Clave</label>
            <input 
                type="password" 
                class="form-control" 
                name="clave" 
                placeholder="Clave" 
                required 
                pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}" 
                title="La clave debe tener al menos 6 caracteres, una letra mayúscula, una letra minúscula y un número."
            >
        </div>
		</div>
		<div class="col-md-6">
        <div class="form-group form-group-default">
        <label>Fecha de Nacimiento</label>
        <input type="date" 
            class="form-control" 
            name="fecha_nacimiento" 
            placeholder="Fecha de Nacimiento" 
            required 
            min="2006-01-01" 
            max="<?php echo date('Y-m-d', strtotime('2050-12-31')); ?>">
        </div>
		</div>
        <div class="col-md-6">
            <input type="hidden" class="form-control" name="cargo" value="2" required>
        </div>
		</div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="add_patient">Agregar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
    </div>
	</div>
</div>

<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
<script src="../assets/js/atlantis.min.js"></script>
<script src="../assets/js/setting-demo2.js"></script>

<script>
    $(document).ready(function() {
        $('#add-row').DataTable({
            "pageLength": 5,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    });

    function activo(codpaci) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡El estado del paciente se cambiará a activo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, cambiar!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../view/config/active.php?id=" + codpaci;
            }
        })
    }

    function inactivo(codpaci) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡El estado del paciente se cambiará a inactivo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, cambiar!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../view/config/inactive.php?id=" + codpaci;
            }
        })
    }
</script>

</body>
</html>
