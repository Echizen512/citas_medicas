<?php
	session_start();
	if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1){
    header('location: ../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Usuarios</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
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
						<h4 class="page-title">Usuarios</h4>
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
										<a href="#addRowModal" class="btn btn-primary btn-round ml-auto" data-toggle="modal">Nuevo</a>
										<?php include('AgregarModal.php'); ?>
									</div>
									<div class="card-tools">
										</div>
										<div class="card-body">
										<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th class="text-center">Nombre</th>
													<th class="text-center">Usuario</th>
													<th class="text-center">Correo</th>
													<th class="text-center">Cargo</th>
													<th style="width: 10%">Acción</th>
												</tr>
											</thead>
										<tbody>
					<?php
						include_once('../view/config/dbconect.php');
						$database = new Connection();
						$db = $database->open();
						try{	
							$sql = 'SELECT * FROM usuarios';
							foreach ($db->query($sql) as $row) {
								?>
								<tr>
									<td class="text-center"><?php echo $row['nombre']; ?></td>
									<td class="text-center"><?php echo $row['usuario']; ?></td>
									<td class="text-center"><?php echo $row['email']; ?></td>
									<td class="text-center">
                <?php    

                if($row['cargo']==1)  { ?> 
                <form  method="get" action="javascript:activo('<?php echo $row['id']; ?>')">
                    
                    <span class="text-success pl-3"><strong>Administrador</strong></span>
                </form>
                <?php  }   else {?> 
                    <form  method="get" action="javascript:inactivo('<?php echo $row['id']; ?>')"> 
                        <span class="text-primary pl-3"><strong>Empleado</strong></span>
                    </form>
                <?php  } ?>                         
            </td>
				<td class="text-center">
				<div class="form-button-action">
					<button href="#editRowModal=<?php echo $row['id'];?>" class="btn btn-link btn-primary btn-lg" data-toggle="modal"  title="" data-original-title="Edit Task" data-target="#editRowModal<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>
					<button href="#PassRowModal=<?php echo $row['id'];?>" class="btn btn-link btn-primary btn-lg" data-toggle="modal"  title="" data-original-title="Pass Task" data-target="#PassRowModal<?php echo $row['id']; ?>"><i class="fa fa-key"></i></button>
				<?php include('editar.php'); ?>
				</div>
				</td>
			</tr>
				<?php 
					}
				}
				catch(PDOException $e){
				echo "Hubo un problema en la conexión: " . $e->getMessage();
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

        $('#addRowButton').click(function() {
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
	function activo(codpaci)
{
	var id=codpaci;
	$.ajax({
        type:"GET",
		url:"../assets/ajax/editar_estado_activo_customers.php?id="+id,
    }).done(function(data){
        window.location.href ='../folder/customers.php';
    })

}

// Editar estado inactivo
function inactivo(codpaci)
{
	var id=codpaci;
	$.ajax({
		type:"GET",
		url:"../assets/ajax/editar_estado_inactivo_customers.php?id="+id,
    }).done(function(data){
        window.location.href ='../folder/customers.php';
    })
}

	</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!--------------------------------script nuevo--------------------------------------------------->

	 <?php
if(isset($_POST["agregar"])){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "consultorio";

// Creamos la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Revisamos la conexión
if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   } 
$nombre=$_POST['nombre'];
$usuario=$_POST['usuario'];
$email=$_POST['email'];
$clave=MD5($_POST['clave']);
$cargo=$_POST['cargo'];


// Realizamos la consulta para saber si coincide con uno de esos criterios
$sql = "select * from usuarios where usuario='$usuario'";
$result = mysqli_query($conn, $sql);
?>


<?php
 // Validamos si hay resultados
 if(mysqli_num_rows($result)>0)
 {
        // Si es mayor a cero imprimimos que ya existe el usuario
      
        if($result){
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
  
 }
 else
 {
// Si no hay resultados, ingresamos el registro a la base de datos
$sql2 = "INSERT INTO usuarios(nombre,usuario,email,clave,cargo)VALUES ('$nombre','$usuario','$email','$clave','$cargo')";


if (mysqli_query($conn, $sql2)) {
      
       if($sql2){
   ?>

        <script type="text/javascript">
             
Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Agregado correctamente',
  showConfirmButton: false,
  timer: 1500
}).then(function() {
            window.location = "../folder/usuarios.php";
        });
        </script>

    <?php
    }
    else{
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