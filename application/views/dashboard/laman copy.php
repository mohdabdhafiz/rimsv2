<section class="section dashboard">

<div class="row">

<div class="col-lg-8">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Taburan Pelapor <span>| Keseluruhan Individu</span></h5>
                            
                            <div class="pt-2 mb-4" style="min-height: 400px;">
                                <canvas id="donutChartPelapor"></canvas>
                            </div>
                        </div>
                        <div class="card-footer">Pelapor Aktif</div>
                    </div>
                </div>
                <!-- End Sales Card -->

            </div>
        </div>
        <!-- End Left side columns -->

    </div>
                    
                            
                            

</div>

</section>

<script>
document.addEventListener("DOMContentLoaded", () => {

    // --- INISIALISASI CARTA DONUT ---
    const ctxDonut = document.querySelector('#donutChartPelapor').getContext('2d');
    chartDonutObj = new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
            labels: <?= $donut_label ?>,
            datasets: [{
                data: <?= $donut_data ?>,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            // ADD THIS SECTION BELOW
            plugins: {
                legend: {
                    position: 'bottom', // Moves labels to the bottom
                    labels: {
                        padding: 20 // Optional: Adds space between chart and labels
                    }
                }
            }
        }
    });

    // --- FUNGSI AUTO UPDATE (AJAX) ---
    function updateDashboard() {
        fetch('<?= site_url("dashboard/data_dashboard") ?>')
        .then(response => response.json())
        .then(data => {

            // 2. UPDATE CARTA BAR
            // Update Label (Nama Isu mungkin berubah)
            chartBarObj.data.labels = data.chart_bar.labels;
            // Update Datasets
            chartBarObj.data.datasets[0].data = data.chart_bar.positif;
            chartBarObj.data.datasets[1].data = data.chart_bar.neutral;
            chartBarObj.data.datasets[2].data = data.chart_bar.negatif;
            chartBarObj.update(); // Refresh chart

            // 3. UPDATE CARTA DONUT
            chartDonutObj.data.labels = data.chart_donut.labels;
            chartDonutObj.data.datasets[0].data = data.chart_donut.data;
            chartDonutObj.update(); // Refresh chart

            // console.log("Dashboard dikemaskini: " + data.timestamp);
        })
        .catch(error => console.error('Ralat mengemaskini dashboard:', error));
    }

    // --- SET INTERVAL ---
    // Jalankan fungsi updateDashboard setiap 5000ms (5 saat)
    setInterval(updateDashboard, 5000);

});
</script>