
<script>
    
    var pieChartContext = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(pieChartContext, {
        type: 'pie',
        data: {
            labels: ['Pacientes', 'Doctores', 'Citas'],
            datasets: [{
                data: [<?php echo $total_pacientes; ?>,
                    <?php echo $total_doctores; ?>,
                    <?php echo $total_citas; ?>
                ],
                backgroundColor: ['#007bff', '#00d2d3',
                    '#f39c12'
                ],
                hoverBackgroundColor: ['#0056b3', '#00b5b5',
                    '#e67e22'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        }
    });

    var citasDiariasChartContext = document.getElementById('citasDiariasChart')
        .getContext('2d');
    var citasDiariasChart = new Chart(citasDiariasChartContext, {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_column($citas_diarias, 'fecha')); ?>, // Fechas de las citas
            datasets: [{
                label: 'Citas Diarias',
                data: <?php echo json_encode(array_column($citas_diarias, 'total')); ?>, // Total de citas por fecha
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Fecha'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Cantidad de Citas'
                    },
                    beginAtZero: true
                }
            }
        }
    });

</script>