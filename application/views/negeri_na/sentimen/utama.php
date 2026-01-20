
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Papan Pemuka Sentimen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('sentimen/urus_tadbir') ?>">Utama</a></li>
                <li class="breadcrumb-item active">Analisis Isu & Sentimen</li>
            </ol>
        </nav>
    </div><section class="section dashboard">
        <div class="row">

            <div class="col-lg-8">
                <div class="row">

                    <div class="col-xxl-4 col-md-6">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Isu Aktif <span>| Semasa</span></h5>
            <div class="d-flex align-items-center">
                <div class="ps-3">
                    <h6 id="kpi-aktif"><?= $statistik->jumlah_isu_aktif ?></h6>
                    <span class="text-success small pt-1 fw-bold">Dipantau</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xxl-4 col-md-6">
    <div class="card info-card revenue-card"> <div class="card-body">
            <h5 class="card-title">Sentimen Dominan</h5>
            <div class="d-flex align-items-center">
                 <div class="ps-3">
                    <h6 id="kpi-dominan"><?= $statistik->dominan_keseluruhan ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xxl-4 col-xl-12">
    <div class="card info-card customers-card">
        <div class="card-body">
            <h5 class="card-title">Isu Kritikal</h5>
            <div class="d-flex align-items-center">
                 <div class="ps-3">
                    <h6 id="kpi-isu-kritikal"><?= substr($statistik->isu_paling_negatif, 0, 25) ?>...</h6>
                    <span id="kpi-jumlah-kritikal" class="text-danger small pt-1 fw-bold"><?= $statistik->jumlah_paling_negatif ?></span> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Analisis 5 Isu Utama <span>| Pecahan Sentimen</span></h5>
                                <canvas id="topIsuChart" style="max-height: 400px;"></canvas>
                            </div>
                        </div>
                    </div><div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Senarai Isu <span>| Status Semasa</span></h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Isu</th>
                                            <th scope="col">Tarikh</th>
                                            <th scope="col" class="text-center">Jumlah</th>
                                            <th scope="col" class="text-center">Dominan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($senarai_isu as $isu): ?>
                                        <tr>
                                            <td class="fw-bold text-primary"><?= $isu->sit_isu ?></td>
                                            <td><?= date('d/m/Y', strtotime($isu->sit_tarikh_dibina)) ?></td>
                                            <td class="text-center fw-bold"><?= $isu->jumlah_laporan ?></td>
                                            <td class="text-center">
                                                <?php if($isu->sentimen_dominan == 'Positif'): ?>
                                                    <span class="badge bg-success"><i class="bi bi-emoji-smile me-1"></i> Positif</span>
                                                <?php elseif($isu->sentimen_dominan == 'Negatif'): ?>
                                                    <span class="badge bg-danger"><i class="bi bi-emoji-frown me-1"></i> Negatif</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"><i class="bi bi-emoji-neutral me-1"></i> Neutral</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($isu->sit_aktif == 'YA'): ?>
                                                    <span class="badge bg-success">Aktif</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark">Arkib</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= site_url('sentimen/kemaskini_isu/'.$isu->sit_bil) ?>" class="btn btn-sm btn-outline-primary" title="Kemaskini"><i class="bi bi-pencil-square"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div></div>
            </div><div class="col-lg-4">

                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Taburan Sentimen <span>| Keseluruhan</span></h5>
                        
                        <div class="pt-2 mb-4" style="min-height: 400px;">
                            <canvas id="donutChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Panduan <span>| Ikon</span></h5>
                        <div class="activity">
                            <div class="activity-item d-flex">
                                <div class="activite-label text-success"><i class="bi bi-check-circle-fill"></i></div>
                                <div class="activity-content ms-2">Sentimen Positif</div>
                            </div>
                            <div class="activity-item d-flex mt-2">
                                <div class="activite-label text-secondary"><i class="bi bi-dash-circle-fill"></i></div>
                                <div class="activity-content ms-2">Sentimen Neutral</div>
                            </div>
                            <div class="activity-item d-flex mt-2">
                                <div class="activite-label text-danger"><i class="bi bi-exclamation-circle-fill"></i></div>
                                <div class="activity-content ms-2">Sentimen Negatif</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div></div>
    </section>

</main><script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    
    // 1. DEFINISI VARIABLE CHART SUPAYA BOLEH DIUPDATE
    let chartBarObj = null;
    let chartDonutObj = null;

    // --- INISIALISASI CARTA BAR ---
    const ctxBar = document.querySelector('#topIsuChart').getContext('2d');
    chartBarObj = new Chart(ctxBar, {
        type: 'bar',
        data: {
            // Masukkan data PHP awal di sini
            labels: <?= $carta_isu_label ?>, 
            datasets: [{
                label: 'Positif',
                data: <?= $carta_isu_positif ?>,
                backgroundColor: '#2eca6a',
                borderRadius: 4
            }, {
                label: 'Neutral',
                data: <?= $carta_isu_neutral ?>,
                backgroundColor: '#aab7cf',
                borderRadius: 4
            }, {
                label: 'Negatif',
                data: <?= $carta_isu_negatif ?>,
                backgroundColor: '#ff771d',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { stacked: true },
                y: { stacked: true, beginAtZero: true }
            }
        }
    });

    // --- INISIALISASI CARTA DONUT ---
    const ctxDonut = document.querySelector('#donutChart').getContext('2d');
    chartDonutObj = new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
            labels: <?= $donut_label ?>,
            datasets: [{
                data: <?= $donut_data ?>,
                backgroundColor: ['#ff771d',  '#4154f1', '#2eca6a'],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
        }
    });

    // --- FUNGSI AUTO UPDATE (AJAX) ---
    function updateDashboard() {
        fetch('<?= site_url("sentimen/data_dashboard_ajax") ?>')
        .then(response => response.json())
        .then(data => {
            
            // 1. UPDATE KAD KPI
            document.getElementById('kpi-aktif').innerText = data.kpi.aktif;
            document.getElementById('kpi-dominan').innerText = data.kpi.dominan;
            
            // Format teks isu kritikal supaya tak terlalu panjang
            let isuKritikal = data.kpi.isu_kritikal;
            if(isuKritikal.length > 25) isuKritikal = isuKritikal.substring(0, 25) + '...';
            document.getElementById('kpi-isu-kritikal').innerText = isuKritikal;
            
            document.getElementById('kpi-jumlah-kritikal').innerText = data.kpi.jumlah_kritikal;

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
