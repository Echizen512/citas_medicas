<?php
session_start();
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 2) {
	header('location: ../../login.php');
}
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Citas</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../../assets/img/icon.ico" type="image/x-icon" />
    <script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
    WebFont.load({
        google: {
            "families": ["Lato:300,400,700,900"]
        },
        custom: {
            "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                "simple-line-icons"
            ],
            urls: ['../../assets/css/fonts.min.css']
        },
        active: function() {
            sessionStorage.fonts = true;
        }
    });
    </script>

    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/atlantis.min.css">
    <link rel="stylesheet" href="../../assets/css/demo.css">
</head>

<body>

    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="../user/user.php" class="logo" style="color: White;">User
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>

            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

                <div class="container-fluid">
                    <div class="collapse" id="search-nav">
                        <form class="navbar-left navbar-form nav-search mr-md-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pr-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Buscar ..." class="form-control">
                            </div>
                        </form>
                    </div>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item toggle-nav-search hidden-caret">
                            <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button"
                                aria-expanded="false" aria-controls="search-nav">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                <li>
                                    <div class="dropdown-title">You have 0 new notification</div>
                                </li>
                                <li>

                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);">See all notifications<i
                                            class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="../../assets/img/Perfil.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img src="../../assets/img/Perfil.jpg"
                                                    alt="image profile" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4><?php echo ucfirst($_SESSION['nombre']); ?></h4>
                                                <p class="text-muted">Paciente</p>
                                            </div>
                                        </div>
                                    </li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../../cerrarSesion.php">Cerrar Sesión</a>
                                    </l>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="../../assets/img/Perfil.jpg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    <?php echo ucfirst($_SESSION['nombre']); ?>
                                    <span class="user-level">Perfil</span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>
                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="../../cerrarSesion.php">
                                            <span class="link-collapse">Cerrar Sesión</span>
                                        </a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#index">
                                <i class="fas fa-home"></i>
                                <p>Inicio</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="index">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="../user/user.php">
                                            <span class="sub-item">Mostrar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item active">
                            <a data-toggle="collapse" href="#base">
                                <i class="fas fa-layer-group"></i>
                                <p>Citas</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="base">
                                <ul class="nav nav-collapse">


                                    <li>
                                        <a href="mostrar.php">
                                            <span class="sub-item">Mostrar</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Citas</h4>
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
                                    <h4 class="card-title">Mis citas</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>DNI</th>
                                                    <th>Paciente</th>
                                                    <th>Fecha</th>
                                                    <th>Hora</th>
                                                    <th>Médico</th>
                                                    <th>Área Médica</th>
                                                    <th style="width: 10%">Estado</th>
                                                    <th>Acción</th> <!-- Nueva columna -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
												if (isset($_SESSION['id'])) {
													include "../config/conex.php";
													$id = $_SESSION['id'];
													$sql = "SELECT appointment.codcit, appointment.dates, appointment.hour, customers.codpaci, 
                                customers.dnipa, customers.nombrep, customers.apellidop, doctor.coddoc, doctor.dnidoc, doctor.nomdoc, 
                                doctor.apedoc, specialty.codespe, specialty.nombrees, appointment.estado 
                                FROM appointment 
                                INNER JOIN customers ON appointment.codpaci=customers.codpaci 
                                INNER JOIN doctor ON appointment.coddoc=doctor.coddoc 
                                INNER JOIN specialty ON appointment.codespe=specialty.codespe 
                                WHERE customers.codpaci='$id'";
													$query = mysqli_query($conex, $sql);
													if (mysqli_num_rows($query) > 0) {
														while ($row = mysqli_fetch_assoc($query)) {
															?>
                                                <tr>
                                                    <td><?php echo $row['dnipa']; ?></td>
                                                    <td><?php echo $row['nombrep']; ?> <?php echo $row['apellidop']; ?>
                                                    </td>
                                                    <td><?php echo date('d/m/Y', strtotime($row['dates'])); ?></td>
                                                    <td><?php echo $row['hour']; ?></td>
                                                    <td><?php echo $row['nomdoc']; ?> <?php echo $row['apedoc']; ?></td>
                                                    <td><?php echo $row['nombrees']; ?></td>
                                                    <td>
                                                        <?php if ($row['estado'] == 1) { ?>
                                                        <span class="badge badge-success">Atendido</span>
                                                        <?php } else { ?>
                                                        <span class="badge badge-danger">Pendiente</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php
																	// Verificar si existe un pago para la cita
																	$codcit = $row['codcit'];
																	$sql_pago = "SELECT COUNT(*) AS total FROM pagos WHERE codcit = ?";
																	$stmt_pago = mysqli_prepare($conex, $sql_pago);
																	mysqli_stmt_bind_param($stmt_pago, "i", $codcit);
																	mysqli_stmt_execute($stmt_pago);
																	$result_pago = mysqli_stmt_get_result($stmt_pago);
																	$pago = mysqli_fetch_assoc($result_pago);

																	if ($pago['total'] > 0) {
																		// Si ya existe un pago, mostrar botón de Generar Factura
																		echo '<form action="reporte.php" method="GET" target="_blank">
																					<input type="hidden" name="codcit" value="' . $codcit . '">
																					<button type="submit" class="btn btn-danger btn-sm" style="border-radius: 20px;">Generar Factura</button>
																				</form>';
																			} else {
																				echo '<form action="pagos.php" method="GET">
																						<input type="hidden" name="codcit" value="' . $codcit . '">
																						<button type="submit" class="btn btn-primary btn-sm" style="border-radius: 20px;">Realizar Pago</button>
																					</form>';
																			}
																	?>
                                                    </td>
                                                </tr>
                                                <?php
														}
													} else {
														?>
                                                <tr>
                                                    <td colspan="8" class="text-center">
                                                        <p class="alert alert-warning">No cuenta con ninguna cita</p>
                                                    </td>
                                                </tr>
                                                <?php
													}
												} else {
													header('location:mostrar.php');
												}
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

        <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
        <script src="../../assets/js/core/popper.min.js"></script>
        <script src="../../assets/js/core/bootstrap.min.js"></script>
        <script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
        <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
        <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
        <script src="../../assets/js/atlantis.min.js"></script>
        <script src="../../assets/js/setting-demo2.js"></script>

</body>

</html>