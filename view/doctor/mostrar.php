<?php
session_start();
	if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
	header('location: ../login.php');
}

?>

<body>

	<?php
		include '../Includes/Head.php';
		include '../Includes/Header.php';
		include '../Includes/Navbar.php';
		include '../Includes/Sidebar.php';
	?>

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				<div class="page-header">
					<h4 class="page-title">Medicos</h4>
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
									<a href="#addRowModal" class="btn btn-primary btn-round ml-auto"
										data-toggle="modal">Nuevo</a>
									<?php include('AgregarModal.php'); ?>

								<div class="card-tools mt-4 mb-3 ml-4">
									<a href="../view/doctor/reporte.php"
										class="btn btn-info btn-border btn-round btn-sm mr-2">
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
													<th class="text-center">C.I</th>
													<th class="text-center">Doctor</th>
													<th class="text-center">Especialidad</th>
													<th class="text-center">Municipio</th>
													<th class="text-center">Estado</th>
													<th style="width: 10%">Acción</th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach ($dato as $key => $value) {
													foreach ($value as $va) { ?>
														<tr>
															<td class="text-center"><?php echo $va['dnidoc']; ?></td>
															<td class="text-center"><?php echo $va['nomdoc']; ?>&nbsp;<?php echo $va['apedoc']; ?>
															</td>
															<td class="text-center"><?php echo $va['nombrees']; ?></td>
															<td class="text-center"><?php echo $va['naciona']; ?></td>
															<td class="text-center">
																<?php if ($va['estado'] == 1) { ?>
																	<form method="get"
																		action="javascript:activo('<?php echo $va['coddoc']; ?>')">
																		<button type="submit"
																			class="btn btn-success btn-xs">Activo</button>
																	</form>
																<?php } else { ?>
																	<form method="get"
																		action="javascript:inactivo('<?php echo $va['coddoc']; ?>')">
																		<button type="submit"
																			class="btn btn-danger btn-xs">Inactivo</button>
																	</form>
																<?php } ?>
															</td>
															<td class="text-center">
																<div class="form-button-action">
																	<a href="#editRowModal_<?php echo $va["coddoc"]; ?>"
																		title="Editar" data-backdrop="false"
																		class="btn btn-link btn-primary btn-lg"
																		data-toggle="modal"><i class="fa fa-edit"></i></a>
																</div>
															</td>
															<?php include('editar.php'); ?>
														</tr>
														<?php
													}
												}
												?>
											</tbody>
											<?php include('AgregarModal.php'); ?>
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
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="../assets/js/functions3.js"></script>
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
    $(document).ready(function () {
        $('#basic-datatables').DataTable({
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

        $('#multi-filter-select').DataTable({
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
            },
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                        );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

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

        var action = '<td class="text-center"> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';
        $('#addRowButton').click(function () {
            $('#add-row').dataTable().fnAddData([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action
            ]);
            $('#addRowModal').modal('hide');
        });
    });
</script>


	<script>
		function activo(coddoc) {
			var id = coddoc;
			$.ajax({
				type: "GET",
				url: "../assets/ajax/editar_estado_activo_doctor.php?id=" + id,
			}).done(function (data) {
				window.location.href = '../folder/doctor.php';
			})
		}

		// Editar estado inactivo
		function inactivo(coddoc) {
			var id = coddoc;
			$.ajax({
				type: "GET",
				url: "../assets/ajax/editar_estado_inactivo_doctor.php?id=" + id,
			}).done(function (data) {
				window.location.href = '../folder/doctor.php';
			})
		}

	</script>
	
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<?php
	if (isset($_POST["agregar"])) {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "consultorio";
		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$dnidoc = $_POST['dnidoc'];
		$nomdoc = $_POST['nomdoc'];
		$apedoc = $_POST['apedoc'];
		$codespe = $_POST['codespe'];
		$sexo = $_POST['sexo'];
		$telefo = $_POST['telefo'];
		$fechanaci = $_POST['fechanaci'];
		$naciona = $_POST['naciona'];
		$sql = "select * from doctor where dnidoc='$dnidoc' or telefo='$telefo'";
		$result = mysqli_query($conn, $sql);
		?>


		<?php
		if (mysqli_num_rows($result) > 0) {
			if ($result) {
		?>

				<script type="text/javascript">
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Ya existe el registro a agregar!'
					})
				</script>

				<?php
			}
		} else {
			$sql2 = "INSERT INTO doctor(dnidoc,nomdoc,apedoc,codespe,sexo,telefo,fechanaci,correo,naciona,estado)VALUES ('$dnidoc','$nomdoc','$apedoc','$codespe','$sexo','$telefo','$fechanaci','$correo','$naciona','1')";
			if (mysqli_query($conn, $sql2)) {
				if ($sql2) {
					?>
					<script type="text/javascript">
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Agregado correctamente',
							showConfirmButton: false,
							timer: 1500
						}).then(function () {
							window.location = "../folder/doctor.php";
						});
					</script>
					<?php
				} else {
					?>
					<script type="text/javascript">
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'No se pudo guardar!'

						})
					</script>
					<?php
				}
			} else {
				echo "Error: " . $sql2 . "" . mysqli_error($conn);
			}
		}
		// Cerramos la conexión
		$conn->close();

	}
	?>
</body>

</html>