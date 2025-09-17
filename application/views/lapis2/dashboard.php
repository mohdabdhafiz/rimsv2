<div class="pagetitle">
    <h1>Dashboard Eksekutif</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active">Dashboard LAPIS 2.0</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">

        <!-- KEMAS KINI DI SINI: Menambah Borang Penapis Tarikh -->
        <div class="row">
                <div class="col-12">
                        <div class="card">
                                <div class="card-body">
                                        <h5 class="card-title">Penapis Tarikh</h5>
                                        <?= form_open("lapis2/dashboard", array("method" => "POST")) ?>
                                                <div class="row g-3 align-items-end">
                                                        <div class="col-md-5">
                                                                <label for="inputTarikhMula" class="form-label">Dari</label>
                                                                <input type="date" class="form-control" id="inputTarikhMula" name="inputTarikhMula" value="<?= isset($tarikhMula) && !empty($tarikhMula) ? date('Y-m-d', strtotime($tarikhMula)) : '' ?>">
                                                        </div>
                                                        <div class="col-md-5">
                                                                <label for="inputTarikhTamat" class="form-label">Hingga</label>
                                                                <input type="date" class="form-control" id="inputTarikhTamat" name="inputTarikhTamat" value="<?= isset($tarikhTamat) && !empty($tarikhTamat) ? date('Y-m-d', strtotime($tarikhTamat)) : '' ?>">
                                                        </div>
                                                        <div class="col-md-2">
                                                                <button type="submit" class="btn btn-primary w-100">Tapis</button>
                                                        </div>
                                                </div>
                                        <?= form_close() ?>
                                </div>
                        </div>
                </div>
        </div>
        <!-- TAMAT KEMAS KINI -->

        <div class="row">
                <!-- Kolum Utama (Carta & Senarai Kluster) -->
                <div class="col-lg-8">
                        <div class="row">
                                <!-- Carta Pai -->
                                <div class="col-12">
                                        <div class="card">
                                                <div class="card-body">
                                                        <h5 class="card-title">Pecahan Laporan Mengikut Kluster</h5>
                                                        <canvas id="pieChart" style="max-height: 400px;"></canvas>
                                                </div>
                                        </div>
                                </div>

                                <!-- Senarai Kluster -->
                                <?php if(!empty($senarai_kluster_data)): foreach($senarai_kluster_data as $kluster): ?>
                                <div class="col-12">
                                        <div class="card">
                                                <div class="card-body">
                                                        <h5 class="card-title"><?= htmlspecialchars(strtoupper($kluster['nama']), ENT_QUOTES, 'UTF-8') ?> <span>| <?= $kluster['jumlah'] ?> Laporan</span></h5>
                                                        
                                                        <ul class="list-group list-group-flush">
                                                                <?php if(!empty($kluster['isu_utama'])): foreach($kluster['isu_utama'] as $isu): ?>
                                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <?= htmlspecialchars($isu->lapis_tajuk_isu, ENT_QUOTES, 'UTF-8') ?>
                                                                        <span class="badge bg-primary rounded-pill"><?= $isu->jumlah ?></span>
                                                                </li>
                                                                <?php endforeach; else: ?>
                                                                <li class="list-group-item text-muted">Tiada isu utama direkodkan.</li>
                                                                <?php endif; ?>
                                                        </ul>
                                                </div>
                                        </div>
                                </div>
                                <?php endforeach; endif; ?>
                        </div>
                </div>

                <!-- Kolum Sisi (Kad Statistik) -->
                <div class="col-lg-4">
                        <div class="card">
                                <div class="card-body">
                                        <h5 class="card-title">Statistik <span>| <?= (isset($tarikhMula) && $tarikhMula) ? date('d/m/y', strtotime($tarikhMula)) . ' - ' . date('d/m/y', strtotime($tarikhTamat)) : 'Keseluruhan' ?></span></h5>
                                        
                                        <div class="d-flex align-items-center mb-3">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary-light">
                                                        <i class="bi bi-journal-text text-primary"></i>
                                                </div>
                                                <div class="ps-3">
                                                        <h6><?= isset($jumlah_laporan) ? $jumlah_laporan : 0 ?></h6>
                                                        <span class="text-muted small pt-2">Jumlah Laporan</span>
                                                </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success-light">
                                                        <i class="bi bi-grid text-success"></i>
                                                </div>
                                                <div class="ps-3">
                                                        <h6><?= isset($senarai_kluster_data) ? count($senarai_kluster_data) : 0 ?></h6>
                                                        <span class="text-muted small pt-2">Jumlah Kluster Aktif</span>
                                                </div>
                                        </div>

                                </div>
                        </div>

                        <!-- KEMAS KINI DI SINI: Menambah Kad Prestasi Status -->
                        <div class="card">
                                <div class="card-body">
                                        <h5 class="card-title">Prestasi Laporan <span>| Mengikut Status</span></h5>
                                        <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        Laporan Diterima
                                                        <span class="badge bg-success rounded-pill"><?= isset($prestasi_status['Laporan Diterima']) ? $prestasi_status['Laporan Diterima'] : 0 ?></span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        Laporan Dipinda
                                                        <span class="badge bg-warning rounded-pill"><?= isset($prestasi_status['Laporan Dipinda']) ? $prestasi_status['Laporan Dipinda'] : 0 ?></span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        Laporan Ditolak
                                                        <span class="badge bg-danger rounded-pill"><?= isset($prestasi_status['Laporan Ditolak']) ? $prestasi_status['Laporan Ditolak'] : 0 ?></span>
                                                </li>
                                        </ul>
                                </div>
                        </div>
                        <!-- TAMAT KEMAS KINI -->

                        <!-- Kad Pecahan Peratusan -->
                        <div class="card">
                                <div class="card-body">
                                        <h5 class="card-title">Peratusan Kluster</h5>
                                        <?php if(!empty($senarai_kluster_data)): foreach($senarai_kluster_data as $kluster): ?>
                                        <div class="mb-3">
                                                <div class="d-flex justify-content-between">
                                                        <span><?= htmlspecialchars($kluster['nama'], ENT_QUOTES, 'UTF-8') ?></span>
                                                        <span><?= $kluster['peratus'] ?>%</span>
                                                </div>
                                                <div class="progress" style="height: 10px;">
                                                        <div class="progress-bar" role="progressbar" style="width: <?= $kluster['peratus'] ?>%" aria-valuenow="<?= $kluster['peratus'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                        </div>
                                        <?php endforeach; else: ?>
                                                <p class="text-center text-muted">Tiada data untuk dipaparkan.</p>
                                        <?php endif; ?>
                                </div>
                        </div>
                </div>
        </div>

        <!-- KEMAS KINI DI SINI: Menambah Jadual Prestasi Negeri -->
        <div class="row">
                <div class="col-12">
                        <div class="card">
                                <div class="card-body">
                                        <h5 class="card-title">Prestasi Pelaporan Mengikut Negeri</h5>
                                        <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover">
                                                        <thead class="table-light">
                                                                <tr>
                                                                        <th>#</th>
                                                                        <th>NEGERI</th>
                                                                        <th>POLITIK</th>
                                                                        <th>EKONOMI</th>
                                                                        <th>SOSIAL</th>
                                                                        <th>KESELAMATAN</th>
                                                                        <th>FASILITI AWAM</th>
                                                                        <th>TELEKOMUNIKASI</th>
                                                                        <th>JUMLAH</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                                <?php if(!empty($prestasi_negeri)): $no = 1; foreach($prestasi_negeri as $negeri => $data_kluster): ?>
                                                                <tr>
                                                                        <td><?= $no++ ?></td>
                                                                        <td><strong><?= strtoupper($negeri) ?></strong></td>
                                                                        <td><?= isset($data_kluster['POLITIK']) ? $data_kluster['POLITIK'] : 0 ?></td>
                                                                        <td><?= isset($data_kluster['EKONOMI']) ? $data_kluster['EKONOMI'] : 0 ?></td>
                                                                        <td><?= isset($data_kluster['SOSIAL']) ? $data_kluster['SOSIAL'] : 0 ?></td>
                                                                        <td><?= isset($data_kluster['KESELAMATAN']) ? $data_kluster['KESELAMATAN'] : 0 ?></td>
                                                                        <td><?= isset($data_kluster['FASILITI AWAM']) ? $data_kluster['FASILITI AWAM'] : 0 ?></td>
                                                                        <td><?= isset($data_kluster['TELEKOMUNIKASI']) ? $data_kluster['TELEKOMUNIKASI'] : 0 ?></td>
                                                                        <td><strong><?= isset($data_kluster['JUMLAH']) ? $data_kluster['JUMLAH'] : 0 ?></strong></td>
                                                                </tr>
                                                                <?php endforeach; else: ?>
                                                                <tr>
                                                                        <td colspan="9" class="text-center">Tiada data untuk dipaparkan.</td>
                                                                </tr>
                                                                <?php endif; ?>
                                                        </tbody>
                                                </table>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <!-- TAMAT KEMAS KINI -->

        <!-- KEMAS KINI DI SINI: Menambah Jadual Prestasi Negeri Mengikut Status -->
        <div class="row">
                <div class="col-12">
                        <div class="card">
                                <div class="card-body">
                                        <h5 class="card-title">Prestasi Pelaporan Mengikut Negeri & Status</h5>
                                        <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover">
                                                        <thead class="table-light">
                                                                <tr>
                                                                        <th>#</th>
                                                                        <th>NEGERI</th>
                                                                        <th>DITERIMA</th>
                                                                        <th>DIPINDA</th>
                                                                        <th>DITOLAK</th>
                                                                        <th>JUMLAH</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                                <?php if(!empty($prestasi_status_negeri)): $no = 1; foreach($prestasi_status_negeri as $negeri => $data_status): ?>
                                                                <tr>
                                                                        <td><?= $no++ ?></td>
                                                                        <td><strong><?= strtoupper($negeri) ?></strong></td>
                                                                        <td><?= isset($data_status['Laporan Diterima']) ? $data_status['Laporan Diterima'] : 0 ?></td>
                                                                        <td><?= isset($data_status['Laporan Dipinda']) ? $data_status['Laporan Dipinda'] : 0 ?></td>
                                                                        <td><?= isset($data_status['Laporan Ditolak']) ? $data_status['Laporan Ditolak'] : 0 ?></td>
                                                                        <td><strong><?= isset($data_status['JUMLAH']) ? $data_status['JUMLAH'] : 0 ?></strong></td>
                                                                </tr>
                                                                <?php endforeach; else: ?>
                                                                <tr>
                                                                        <td colspan="6" class="text-center">Tiada data untuk dipaparkan.</td>
                                                                </tr>
                                                                <?php endif; ?>
                                                        </tbody>
                                                </table>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <!-- TAMAT KEMAS KINI -->

</section>

<!-- Skrip untuk Chart.js (pastikan ia dimuatkan dalam fail bawah.php anda) -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    new Chart(document.querySelector('#pieChart'), {
        type: 'pie',
        data: {
            labels: <?= $chart_labels ?>,
            datasets: [{
                label: 'Jumlah Laporan',
                data: <?= $chart_data ?>,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)'
                ],
                hoverOffset: 4
            }]
        }
    });
});
</script>
