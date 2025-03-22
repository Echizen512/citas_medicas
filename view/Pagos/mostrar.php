<?php

session_start();

if (!isset($_SESSION['cargo']) || !in_array($_SESSION['cargo'], [1, 3, 4])) {

    header('location: ../login.php');
    exit();
}

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "consultorio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $consulta = "SELECT id_pago, codcit, codpaci, coddoc, monto, monto_bs, metodo_pago, referencia, fecha FROM pagos";
    $result = $conn->query($consulta);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Medicos</title>
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

<div class="wrapper">
    <div class="main-header">
        <div class="logo-header" data-background-color="blue">

            <a href="admin.php" class="logo" style="color: white"></a>
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
                        </ul>
                    </li>

                    <li class="nav-item dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="../../assets/img/mujer.png" alt="..." class="avatar-img rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">

                                        <div class="avatar-lg"><img src="../../assets/img/mujer.png" alt="image profile"
                                                class="avatar-img rounded"></div>
                                        <div class="u-text">
                                            <h4><?php echo ucfirst($_SESSION['nombre']); ?></h4>
                                            <p class="text-muted"></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../../cerrarSesion.php">Cerrar Sesión</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <?php
session_start();

$cargo = isset($_SESSION['cargo']) ? $_SESSION['cargo'] : null;
?>

<div class="sidebar sidebar-style-2">           
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="../../assets/img/mujer.png" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?php echo ucfirst($_SESSION['nombre']); ?>
                            <span class="user-level">
                                <?php

                                switch ($cargo) {
                                    case 1: echo "Administrador"; break;
                                    case 3: echo "Secretaria"; break;
                                    case 4: echo "Médico"; break;
                                    default: echo "Invitado"; break;
                                }
                                ?>
                            </span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <?php
                if ($cargo == 1) {
                    ?>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Citas</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../../folder/appointment.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-male"></i>
                            <p>Pacientes</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="sidebarLayouts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../../folder/customers.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#forms">
                            <i class="fas fa-user-md"></i>
                            <p>Médicos</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../../folder/doctor.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#tables">
                            <i class="fas fa-table"></i>
                            <p>Áreas médicas</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../../folder/specialty.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#user">
                            <i class="fas fa-user"></i>
                            <p>Usuarios</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="user">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../../folder/usuarios.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#pagos">
                            <i class="fas fa-money-bill-wave"></i>
                            <p>Pagos</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="pagos">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../pagos/mostrar.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#auditoria">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Auditoría</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="auditoria">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../audit/mostrar.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#backup">
                            <i class="fas fa-download"></i>
                            <p>Respaldo</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="backup">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../backup/mostrar.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                    </li>

                    <?php
                } elseif ($cargo == 3) {
                    ?>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Citas</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../../folder/appointment.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#pagos">
                            <i class="fas fa-money-bill-wave"></i>
                            <p>Pagos</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="pagos">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../pagos/mostrar.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <?php
                } elseif ($cargo == 4) {
                    ?>
                     <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Citas</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../../folder/appointment.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-male"></i>
                            <p>Pacientes</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="sidebarLayouts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../../folder/customers.php">
                                        <span class="sub-item">Mostrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <p>No tienes permisos para ver el contenido.</p>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>
</div>

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Pagos</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="../../view/admin/admin.php">
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
                                </div>
                                <div class="card-tools mt-4 mb-3 ml-2">
                                    <a href="../../view/pagos/reporte.php"
                                        class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                        Exportar PDF
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Código Cita</th>
                                                <th class="text-center">Código Paciente</th>
                                                <th class="text-center">($)</th>
                                                <th class="text-center">(Bs)</th>
                                                <th class="text-center">Método de Pago</th>
                                                <th class="text-center">Referencia</th>
                                                <th class="text-center">Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    // Asignar el nombre del método de pago según su código
                                    $metodo_pago = "";
                                    switch ($row['metodo_pago']) {
                                        case 1:
                                            $metodo_pago = "Pago Movil";
                                            break;
                                        case 2:
                                            $metodo_pago = "PayPal";
                                            break;
                                        case 3:
                                            $metodo_pago = "Binance";
                                            break;
                                        case 4:
                                            $metodo_pago = "Efectivo";
                                            break;
                                        default:
                                            $metodo_pago = "Desconocido";
                                    }
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $row['codcit']; ?></td>
                                                <td class="text-center"><?php echo $row['codpaci']; ?></td>
                                                <td class="text-center"><?php echo $row['monto']; ?></td>
                                                <td class="text-center"><?php echo $row['monto_bs']; ?></td>
                                                <td class="text-center"><?php echo $metodo_pago; ?></td>
                                                <td class="text-center"><?php echo $row['referencia']; ?></td>
                                                <td class="text-center"><?php echo $row['fecha']; ?></td>
                                            </tr>
                                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='7'>No se encontraron resultados</td></tr>";
                            }
                            $conn->close();
                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                <script src="../../assets/js/functions3.js"></script>
                <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
                <script src="../../assets/js/core/popper.min.js"></script>
                <script src="../../assets/js/core/bootstrap.min.js"></script>
                <script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
                <script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
                <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
                <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
                <script src="../../assets/js/atlantis.min.js"></script>
                <script src="../../assets/js/setting-demo2.js"></script>


                <script>
                $(document).ready(function() {
                    $('#add-row').DataTable({
                        "language": {
                            "sProcessing": "Procesando...",
                            "sLengthMenu": "Mostrar _MENU_ registros",
                            "sZeroRecords": "No se encontraron resultados",
                            "sEmptyTable": "Ningún dato disponible en esta tabla",
                            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
                        }
                    });
                });
                </script>