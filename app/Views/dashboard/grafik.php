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