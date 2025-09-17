<style>
/* Menambah gaya tambahan untuk panel tindakan dan carta */
.action-panel .list-group-item {
    transition: all 0.2s ease-in-out;
}
.action-panel .list-group-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}
/* Gunakan semula gaya kad gradien dari papan pemuka utama */
.card-gradient { color: white; transition: all 0.3s ease-in-out; }
.card-gradient:hover { transform: translateY(-5px); box-shadow: 0 8px 25px -5px rgba(0,0,0,0.2); }
.bg-gradient-primary { background: linear-gradient(45deg, #4e73df, #224abe); }
.bg-gradient-success { background: linear-gradient(45deg, #1cc88a, #13855c); }
.bg-gradient-info { background: linear-gradient(45deg, #36b9cc, #2a96a5); }
.card-gradient .card-body i { opacity: 0.3; font-size: 3.5rem; }
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Papan Pemuka RIMS@PERSONEL</h1>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card card-gradient bg-gradient-primary shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase">Jumlah Akaun</h6>
                    <h2 class="display-5 fw-bold"><?= $jumlahAkaun->bilangan ?></h2>
                </div>
                <i class="bi bi-people-fill"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-gradient bg-gradient-success shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase">Bilangan Anggota</h6>
                    <h2 class="display-5 fw-bold"><?= $bilanganAnggota->bilangan ?></h2>
                </div>
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-gradient bg-gradient-info shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase">Bilangan Pentadbir</h6>
                    <h2 class="display-5 fw-bold"><?= $bilanganTadbir->bilangan ?></h2>
                </div>
                <i class="bi bi-person-workspace"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card shadow-sm h-100">
            <div class="card-header">
                <strong>Tindakan Pantas</strong>
            </div>
            <div class="card-body action-panel">
                <p class="text-muted">Pilih tindakan yang ingin anda laksanakan berkaitan pengurusan personel dan peranan.</p>
                <div class="list-group list-group-flush">
                    <a href="<?= site_url('personel/carian') ?>" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                        <i class='bx bx-search-alt me-3 fs-3 text-primary'></i>
                        <div>
                            <h6 class="mb-0 fw-bold">Carian Personel</h6>
                            <small>Cari dan lihat maklumat terperinci personel.</small>
                        </div>
                    </a>
                    <a href="<?= site_url('personel/pertukaran') ?>" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                        <i class='bx bx-transfer me-3 fs-3 text-success'></i>
                        <div>
                            <h6 class="mb-0 fw-bold">Urus Pertukaran Personel</h6>
                            <small>Mulakan atau luluskan proses pertukaran peranan atau penempatan.</small>
                        </div>
                    </a>
                    <a href="<?= site_url('pengguna') ?>" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                        <i class='bx bx-list-ul me-3 fs-3 text-info'></i>
                        <div>
                            <h6 class="mb-0 fw-bold">Lihat Senarai Penuh Pengguna</h6>
                            <small>Paparkan senarai kesemua pengguna yang berdaftar.</small>
                        </div>
                    </a>
                    <a href="<?= site_url('peranan') ?>" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                        <i class='bx bx-key me-3 fs-3 text-warning'></i>
                        <div>
                            <h6 class="mb-0 fw-bold">Urus Peranan & Tugasan</h6>
                            <small>Tambah, kemas kini, atau lihat peranan dan tugasan kawasan.</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm h-100">
            <div class="card-header">
                <strong>Pecahan Akaun Pengguna</strong>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <canvas id="personelPieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
// Skrip untuk Carta Pecahan Personel
document.addEventListener("DOMContentLoaded", function() {
    if (typeof Chart !== 'undefined') {
        const ctx = document.getElementById('personelPieChart').getContext('2d');
        const personelPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Anggota", "Pentadbir"],
                datasets: [{
                    data: [
                        <?= $bilanganAnggota->bilangan ?? 0 ?>, 
                        <?= $bilanganTadbir->bilangan ?? 0 ?>
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(54, 185, 204, 0.7)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 185, 204, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    }
});
</script>