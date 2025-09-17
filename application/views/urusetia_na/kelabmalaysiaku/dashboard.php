<style>
/* Gaya sedia ada dikekalkan */
.card-gradient { color: white; transition: all 0.3s ease-in-out; }
.card-gradient:hover { transform: translateY(-5px); box-shadow: 0 8px 25px -5px rgba(0,0,0,0.2); }
.bg-gradient-primary { background: linear-gradient(45deg, #4e73df, #224abe); }
.bg-gradient-success { background: linear-gradient(45deg, #1cc88a, #13855c); }
.bg-gradient-info { background: linear-gradient(45deg, #36b9cc, #2a96a5); }

/* Gaya baharu untuk Hab Tindakan */
.action-card { text-decoration: none; }
.action-card .card { transition: all 0.3s ease-in-out; border-left-width: 4px; }
.action-card .card:hover { transform: scale(1.03); box-shadow: 0 4px 20px -5px rgba(0,0,0,0.15); background-color: #f8f9fa; }
</style>

<div class="card shadow-sm border-0 mb-5" style="background: url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop') center center/cover; color: white;">
    <div class="card-body p-4 p-md-5 text-center" style="background-color: rgba(0,0,0,0.6);">
        <h1 class="display-5 fw-bold">Selamat Datang ke RIMS@KELABMALAYSIAKU</h1>
        <p class="lead col-md-8 mx-auto">Modul ini membolehkan anda mengurus, memantau, dan menganalisis data berkaitan Kelab Malaysiaku di seluruh negara.</p>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-lg-4">
        <div class="card card-gradient bg-gradient-primary shadow-sm border-0 h-100">
            <div class="card-body">
                <h6 class="text-uppercase">Jumlah Kelab Aktif</h6>
                <h2 class="display-5 fw-bold"><?= $am->bilanganKelab ?? '0' ?></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-gradient bg-gradient-success shadow-sm border-0 h-100">
            <div class="card-body">
                <h6 class="text-uppercase">Jumlah Ahli Berdaftar</h6>
                <h2 class="display-5 fw-bold"><?= $am->bilanganAhli ?? '0' ?></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-gradient bg-gradient-info shadow-sm border-0 h-100">
            <div class="card-body">
                <h6 class="text-uppercase">Jumlah Sekolah Terlibat</h6>
                <h2 class="display-5 fw-bold"><?= $am->bilanganSekolah ?? '0' ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="mb-5">
    <h3 class="mb-3 text-center">Apa yang ingin anda lakukan?</h3>
    <div class="row g-4">
        <div class="col-lg-4">
            <a href="<?= site_url('kelabmalaysiaku/daftar') ?>" class="action-card">
                <div class="card shadow-sm border-start border-success h-100">
                    <div class="card-body text-center p-4">
                        <i class='bx bx-plus-circle display-4 text-success mb-2'></i>
                        <h5 class="card-title fw-bold">Daftar Kelab Baharu</h5>
                        <p class="card-text small text-muted">Buka borang untuk mendaftarkan kelab baharu dalam sistem.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="<?= site_url('kelabmalaysiaku/senarai') ?>" class="action-card">
                <div class="card shadow-sm border-start border-primary h-100">
                    <div class="card-body text-center p-4">
                        <i class='bx bx-list-ul display-4 text-primary mb-2'></i>
                        <h5 class="card-title fw-bold">Senarai Penuh & Urus Kelab</h5>
                        <p class="card-text small text-muted">Lihat, kemas kini, atau padam maklumat kelab sedia ada.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="<?= site_url('kelabmalaysiaku/carian') ?>" class="action-card">
                <div class="card shadow-sm border-start border-info h-100">
                    <div class="card-body text-center p-4">
                        <i class='bx bx-search-alt display-4 text-info mb-2'></i>
                        <h5 class="card-title fw-bold">Carian Terperinci</h5>
                        <p class="card-text small text-muted">Cari kelab atau ahli menggunakan pelbagai kriteria.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm h-100">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="negeri-tab" data-bs-toggle="tab" data-bs-target="#negeri" type="button" role="tab" aria-controls="negeri" aria-selected="true">Taburan Ikut Negeri</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="daerah-tab" data-bs-toggle="tab" data-bs-target="#daerah" type="button" role="tab" aria-controls="daerah" aria-selected="false">Ikut Daerah (10 Teratas)</button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="negeri" role="tabpanel" aria-labelledby="negeri-tab">
                        <canvas id="negeriChart" height="150"></canvas>
                    </div>
                    <div class="tab-pane fade" id="daerah" role="tabpanel" aria-labelledby="daerah-tab">
                        <canvas id="daerahChart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-header"><strong>Negeri Teratas (Bilangan Kelab)</strong></div>
            <div class="list-group list-group-flush">
                 <?php foreach($negeriTeratas as $negeri): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <?= $negeri->nt_nama ?>
                        <span class="badge bg-primary rounded-pill"><?= $negeri->jumlahKelab ?? '0' ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (typeof Chart !== 'undefined') {
        // 1. Carta untuk Taburan Negeri
        const ctxNegeri = document.getElementById('negeriChart').getContext('2d');
        const negeriChart = new Chart(ctxNegeri, {
            type: 'bar',
            data: {
                labels: [<?php foreach($senaraiRumusan as $rumusan) { echo "'".$rumusan->nt_nama."',"; } ?>],
                datasets: [{
                    label: 'Jumlah Kelab',
                    data: [<?php foreach($senaraiRumusan as $rumusan) { echo $rumusan->jumlahKelab.","; } ?>],
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: { legend: { display: false } }
            }
        });

        // 2. Carta untuk Taburan Daerah
        const ctxDaerah = document.getElementById('daerahChart').getContext('2d');
        const daerahChart = new Chart(ctxDaerah, {
            type: 'bar',
            data: {
                labels: [<?php foreach($rumusanDaerah as $rumusan) { echo "'".$rumusan->kategoriNama."',"; } ?>],
                datasets: [{
                    label: 'Jumlah Kelab',
                    data: [<?php foreach($rumusanDaerah as $rumusan) { echo $rumusan->jumlahKelab.","; } ?>],
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: { legend: { display: false } }
            }
        });
    }
});
</script>