<?php
session_start();
include "../config/conex.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $codcit = $_GET['codcit'];


    // Obtener datos del paciente y doctor de la cita
    $sql = "SELECT codpaci, coddoc FROM appointment WHERE codcit = ?";
    $stmt = mysqli_prepare($conex, $sql);
    mysqli_stmt_bind_param($stmt, "i", $codcit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "<script>
                Swal.fire('Error', 'Cita no encontrada', 'error').then(() => window.location='index.php');
              </script>";
        exit();
    }

    $codpaci = $row['codpaci'];
    $coddoc = $row['coddoc'];
}


$url = "https://ve.dolarapi.com/v1/dolares";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$tasa_cambio = 0;
if ($response !== false) {
    $data = json_decode($response, true);
    if ($data !== null) {
        $tasa_cambio = $data[0]['promedio'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Pago</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

<body >

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

    <div class="card" style="margin-left: 300px; width: 70%;"> <!-- Ajusta el margen izquierdo según el ancho de tu Sidebar -->
        <div class="card-body" style="margin-top: 80px;">
            <h2 class="text-center">Datos del Pago</h2>
            <form id="formPago" method="POST" action="procesar_pago.php">
                <input type="hidden" name="codcit" value="<?php echo $codcit; ?>">
                <input type="hidden" name="codpaci" value="<?php echo $codpaci; ?>">
                <input type="hidden" name="coddoc" value="<?php echo $coddoc; ?>">
                <input type="hidden" id="tasaCambio" value="<?php echo $tasa_cambio; ?>">

                <div class="mb-3">
                    <label class="form-label">Monto en USD</label>
                    <input type="number" id="monto" name="monto" class="form-control" required step="0.01">
                </div>

                <div class="mb-3">
                    <label class="form-label">Monto en Bolívares</label>
                    <input type="text" id="monto_bs" name="monto_bs" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Método de Pago</label>
                    <select class="form-select" id="metodo_pago" name="metodo_pago" required>
                        <option value="">Seleccione...</option>
                        <option value="1">Pago Móvil</option>
                        <option value="2">PayPal</option>
                        <option value="3">Binance</option>
                        <option value="4">Efectivo</option>
                    </select>
                </div>

                <div id="info_pago" class="alert alert-info d-none"></div>

                <div class="mb-3">
                    <label class="form-label">Referencia</label>
                    <input type="text" name="referencia" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="border-radius: 20px;">Confirmar Pago</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $("#monto").on("input", function () {
                let monto = parseFloat($(this).val());
                let tasa = parseFloat($("#tasaCambio").val());
                if (!isNaN(monto) && !isNaN(tasa)) {
                    $("#monto_bs").val((monto * tasa).toFixed(2));
                } else {
                    $("#monto_bs").val("");
                }
            });

            $("#metodo_pago").change(function () {
                let metodo = $(this).val();
                let info = $("#info_pago");
                info.removeClass("d-none").html("");

                if (metodo == "1") {
                    info.html("<b>Banco:</b> BNC <br> <b>Teléfono:</b> 0424-3365478 <br> <b>Cédula:</b> 11.181.258");
                } else if (metodo == "2") {
                    info.html("<b>Correo Electrónico:</b> example@paypal");
                } else if (metodo == "3") {
                    info.html("<b>Correo Electrónico:</b> example@binance");
                } else {
                    info.addClass("d-none");
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#formPago").submit(function (event) {
                event.preventDefault();
                let formData = $(this).serialize(); 
                $.ajax({
                    type: "POST",
                    url: "procesar_pago.php",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            Swal.fire({
                                title: "Éxito",
                                text: response.message,
                                icon: "success"
                            }).then(() => {
                                window.location = "mostrar.php";
                            });
                        } else {
                            Swal.fire("Error", response.message, "error");
                        }
                    },
                    error: function () {
                        Swal.fire("Error", "Hubo un problema en la solicitud", "error");
                    }
                });
            });
        });
    </script>


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