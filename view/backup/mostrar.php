<?php
session_start();
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Medicos</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon" />
	<script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/css/atlantis.min.css">
	<link rel="stylesheet" href="../../assets/css/demo.css">
</head>
</head>



<style>
    .container {
        margin-top: 50px;
        margin-bottom: 50px;
        padding: 20px;
    }

    .card {
        border-radius: 15px;
        border: 1px solid #dedede;
        max-width: 50%;
        margin: 0 auto;
        border-radius: 50px;
    }

    .card-header {
        border-top-right-radius: 15px;
        border-top-left-radius: 15px;

    }

    .card-header h4 {
        font-family: 'Lato', sans-serif;
        font-weight: 700;
    }

    .card-body {
        background-color: #f8f9fa;
    }

    .btn-success {
        background: linear-gradient(45deg, #4CAF50, #3EBA55);
        border: none;
        border-radius: 20px;
        transition: background 0.3s;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #3EBA55, #4CAF50);
    }

    .btn-secondary {
        background: linear-gradient(45deg, #3498DB, #2980B9);
        border: none;
        border-radius: 20px;
        transition: background 0.3s;
    }

    .btn-secondary:hover {
        background: linear-gradient(45deg, #2980B9, #3498DB);
    }

    .form-control-file {
        background: linear-gradient(45deg,rgb(19, 101, 168),rgb(32, 131, 170));
        border: none;
        color: white;
        border-radius: 20px;
        padding: 10px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .form-control-file:hover {
        background: linear-gradient(45deg,rgb(18, 99, 221),rgb(31, 81, 187));
    }
</style>

<?php include '../../Includes/Header.php'; ?>
<?php include '../../Includes/Navbar.php'; ?>

<div class="wrapper">
		<div class="main-header">

			<div class="logo-header" data-background-color="blue">
				
				<a href="admin.php" class="logo" style="color: white"></a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
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
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									
								</li>
								<li>
								
									
								</li>

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
										
											<div class="avatar-lg"><img src="../../assets/img/mujer.png" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?php echo ucfirst($_SESSION['nombre']); ?></h4>
												<p class="text-muted">Administrador</p>
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
								</span>
							</a>
							<div class="clearfix"></div>
							<div class="collapse in" id="collapseExample">
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
							
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
									
								</ul>
							</div>
						</li>
						

						
					</ul>
				</div>
			</div>
		</div>

<div class="main-panel">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Gestión de Respaldo</h4>
            </div>
            <div class="card-body text-center">
                <button id="backupBtn" class="btn btn-primary" style="border-radius: 50px">Crear Respaldo</button>
                <form id="importForm" enctype="multipart/form-data" class="mt-3">
                    <input type="file" name="backup_file" id="backupFile" class="form-control-file" accept=".sql" required>
                    <button type="submit" class="btn btn-primary mt-2" style="border-radius: 50px;">Importar Respaldo</button>
                </form>
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
    $(document).ready(function () {
        $('#backupBtn').click(function () {
            $.ajax({
                url: 'backup_import.php',
                type: 'POST',
                data: { action: 'backup' },
                dataType: 'json',
                success: function (response) {
                    Swal.fire(response.status === "success" ? "¡Éxito!" : "¡Error!", response.message, response.status);
                },
                error: function () {
                    Swal.fire("¡Error!", "No se pudo crear el respaldo.", "error");
                }
            });
        });

        $('#importForm').submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            formData.append('action', 'import');

            $.ajax({
                url: 'backup_import.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    Swal.fire(response.status === "success" ? "¡Éxito!" : "¡Error!", response.message, response.status);
                },
                error: function () {
                    Swal.fire("¡Error!", "No se pudo importar el respaldo.", "error");
                }
            });
        });
    });
</script>

</body>

</html>