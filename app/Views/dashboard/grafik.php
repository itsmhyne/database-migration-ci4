<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Grafik Peminjaman Ruangan</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                    <div class=""></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                    <div class=""></div>
                </div>
            </div>
            <canvas id="myChart" width="528" height="100" style="display: block; width: 528px; height: 264px;"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<div class="row">
    <div class="col-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Grafik Peminjaman Ruangan</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="align-items: center;">
                <div class="chart" style="width: 400px;">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="pieChart" width="528" height="100" style="display: block; width: 528px; height: 264px;"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-6 -->
</div>
<!-- /.row -->

<?php
if (count($ruangan) > 0) {
    foreach ($ruangan as $key => $value) {
        $ruangan_id[] = $value['ruangan_nama'];
        $peminjaman[] = $value['jumlah'];
    }
} else {
    $ruangan_id[] = 0;
    $peminjaman[] = 0;
}

?>

<script>
    var jumlah = <?php echo '[' . implode(',', $jumlah) . ']'; ?>;
    var ctx = document.getElementById("myChart");
    var data = {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: "Ruangan Dipinjam",
            backgroundColor: "#33cc33",
            borderColor: "#1f7a1f",
            pointBorderColor: "#33cc33",
            pointBackgroundColor: "#33cc33",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "#0292f4",
            tension: 0.4,
            // labels: subtotal_barang_masuk,
            data: jumlah,
        }]
    };
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    userCallback: function(label, index, labels) {
                        // when the floored value is the same as the value we have a whole number
                        if (Math.floor(label) === label) {
                            return label;
                        }

                    },
                }
            }
        }
    });
</script>

<script>
    var ctx2 = document.getElementById('pieChart').getContext('2d');
    var data2 = {
        labels: <?= json_encode($ruangan_id) ?>,
        datasets: [{
            label: '# of Votes',
            data: <?= json_encode($peminjaman) ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    };
    var pieChart = new Chart(ctx2, {
        type: 'pie',
        data: data2,
        options: {
            plugins: {
                tooltip: {
                    enabled: false
                },
                datalabels: {
                    formatter: (value, context) => {
                        const datapoints = context.chart.data.datasets[0].data;

                        function totalSum(total, datapoint) {
                            return total + datapoint;
                        }
                        const totalValue = datapoints.reduce(totalSum, 0);
                        const precentageValue = (value / totalValue * 100).toFixed(1);
                        return `${value}`;
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>