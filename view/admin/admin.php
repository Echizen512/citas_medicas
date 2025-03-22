<?php
	session_start();
		if(!isset($_SESSION['cargo']) == 1){
		header('location: ../../login.php');
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Consultorio Pedátrico</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../../assets/img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/atlantis.min.css">
    <link rel="stylesheet" href="../../assets/css/demo.css">
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
</head>

<body>

    <?php include '../../Includes/Siderbar_Admin.php'; ?>

    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Panel de Control</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="row mt--2">
                    <div class="col-md-6">
                        <div class="card full-height" style="width: 1000px;">
                            <div class="card-body" style="width: 1000px;">
                                <div class="card-title">Resumen</div>
                                <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                    <div class="px-2 pb-2 pb-md-0 text-center">
                                        <div id="circles-1"></div>
                                        <h6 class="fw-bold mt-3 mb-0">Pacientes</h6>
                                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                        <?php include './consult.php'; ?>
                                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                            <div class="px-2 pb-2 pb-md-0 text-center">
                                                <canvas id="pieChart" width="200" height="200"></canvas>
                                                <h6 class="fw-bold mt-3 mb-0">Estadísticas</h6>
                                            </div>

                                            <div class="px-2 pb-2 pb-md-0 text-center">
                                                <canvas id="citasDiariasChart" width="200" height="200"></canvas>
                                                <h6 class="fw-bold mt-3 mb-0">Citas Diarias</h6>
                                            </div>
                                        </div>
                                        <br>
                                        <?php include './chart.php'; ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title fw-mediumbold">Nuevos pacientes</div>
                                                    <?php
												function connect(){
												return new mysqli("localhost","root","","consultorio");
												}
												$con = connect();
												$sql = "SELECT * FROM customers   ORDER BY apellidop ASC LIMIT 5";
												$query  =$con->query($sql);
												$data =  array();
												if($query){
													while($r = $query->fetch_object()){
														$data[] = $r;
													}
												}
												?>
                                                    <?php if(count($data)>0):?>
                                                    <?php foreach($data as $d):?>
                                                    <div class="card-list">

                                                        <div class="item-list">
                                                            <div class="avatar">
                                                                <img src="../../assets/img/Perfil.jpg" alt="..."
                                                                    class="avatar-img rounded-circle">
                                                            </div>
                                                            <div class="info-user ml-3">
                                                                <div class="username"><?php echo $d->apellidop; ?>
                                                                </div>
                                                                <div class="status">Pacientes</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    <?php else:?>
                                                    <p class="alert alert-warning"><strong>No hay datos</strong></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title fw-mediumbold">Nuevos doctores</div>
                                                    <?php
														$con = connect();
														$sql = "SELECT * FROM doctor   ORDER BY apedoc ASC LIMIT 5";
														$query  =$con->query($sql);
														$data =  array();
														if($query){
															while($r = $query->fetch_object()){
																$data[] = $r;
															}
														}
														?>
                                                    <?php if(count($data)>0):?>
                                                    <?php foreach($data as $d):?>
                                                    <div class="card-list">

                                                        <div class="item-list">
                                                            <div class="avatar">
                                                                <img src="../../assets/img/Perfil.jpg" alt="..."
                                                                    class="avatar-img rounded-circle">
                                                            </div>
                                                            <div class="info-user ml-3">
                                                                <div class="username"><?php echo $d->apedoc; ?>
                                                                </div>
                                                                <div class="status">Doctores</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    <?php else:?>
                                                    <p class="alert alert-warning"><strong>No hay datos</strong></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title fw-mediumbold">Nuevos especialidades
                                                    </div>
                                                    <?php
														$con = connect();
														$sql = "SELECT * FROM specialty   ORDER BY nombrees ASC LIMIT 5";
														$query  =$con->query($sql);
														$data =  array();
														if($query){
															while($r = $query->fetch_object()){
																$data[] = $r;
															}
														}
														?>
                                                    <?php if(count($data)>0):?>
                                                    <?php foreach($data as $d):?>
                                                    <div class="card-list">
                                                        <div class="item-list">
                                                            <div class="info-user ml-3">
                                                                <div class="username"><?php echo $d->nombrees; ?>
                                                                </div>
                                                                <div class="status">Especialidades</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    <?php else:?>
                                                    <p class="alert alert-warning"><strong>No hay datos</strong></p>
                                                    <?php endif; ?>
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
                    <script src="../../assets/js/plugin/chart.js/chart.min.js"></script>
                    <script src="../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
                    <script src="../../assets/js/plugin/chart-circle/circles.min.js"></script>
                    <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
                    <script src="../../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
                    <script src="../../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>
                    <script src="../../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
                    <script src="../../assets/js/atlantis.min.js"></script>
                    <script src="../../assets/js/setting-demo.js"></script>
                    <script src="../../assets/js/demo.js"></script>
                    
					<script>
                    Circles.create({
                        id: 'circles-1',
                        radius: 45,
                        value: 60,
                        maxValue: 100,
                        width: 7,
                        text: <?php echo  $total; ?>,
                        colors: ['#f1f1f1', '#FF9E27'],
                        duration: 400,
                        wrpClass: 'circles-wrp',
                        textClass: 'circles-text',
                        styleWrapper: true,
                        styleText: true
                    })

                    Circles.create({
                        id: 'circles-2',
                        radius: 45,
                        value: 70,
                        maxValue: 100,
                        width: 7,
                        text: <?php echo  $total2; ?>,
                        colors: ['#f1f1f1', '#2BB930'],
                        duration: 400,
                        wrpClass: 'circles-wrp',
                        textClass: 'circles-text',
                        styleWrapper: true,
                        styleText: true
                    })

                    Circles.create({
                        id: 'circles-3',
                        radius: 45,
                        value: 40,
                        maxValue: 100,
                        width: 7,
                        text: <?php echo  $total3; ?>,
                        colors: ['#f1f1f1', '#F25961'],
                        duration: 400,
                        wrpClass: 'circles-wrp',
                        textClass: 'circles-text',
                        styleWrapper: true,
                        styleText: true
                    })

                    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

                    var mytotalIncomeChart = new Chart(totalIncomeChart, {
                        type: 'bar',
                        data: {
                            labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
                            datasets: [{
                                label: "Total Income",
                                backgroundColor: '#ff9e27',
                                borderColor: 'rgb(23, 125, 255)',
                                data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: false,
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        display: false
                                    },
                                    gridLines: {
                                        drawBorder: false,
                                        display: false
                                    }
                                }],
                                xAxes: [{
                                    gridLines: {
                                        drawBorder: false,
                                        display: false
                                    }
                                }]
                            },
                        }
                    });

                    $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
                        type: 'line',
                        height: '70',
                        width: '100%',
                        lineWidth: '2',
                        lineColor: '#ffa534',
                        fillColor: 'rgba(255, 165, 52, .14)'
                    });
                    </script>
</body>

</html>