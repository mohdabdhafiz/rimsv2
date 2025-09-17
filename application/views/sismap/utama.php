<style>
/* Gunakan semula gaya kad gradien dari papan pemuka utama */
.card-gradient { color: white; transition: all 0.3s ease-in-out; }
.card-gradient:hover { transform: translateY(-5px); box-shadow: 0 8px 25px -5px rgba(0,0,0,0.2); }
.bg-gradient-primary { background: linear-gradient(45deg, #4e73df, #224abe); }
.bg-gradient-success { background: linear-gradient(45deg, #1cc88a, #13855c); }
.bg-gradient-info { background: linear-gradient(45deg, #36b9cc, #2a96a5); }
.bg-gradient-warning { background: linear-gradient(45deg, #f6c23e, #dda20a); }
.card-gradient .card-body i { opacity: 0.3; font-size: 3.5rem; }

/* Gaya untuk kad pelancar (launcher) */
.launcher-card {
    text-decoration: none;
    transition: all 0.3s ease-in-out;
}
.launcher-card .card:hover {
    border-color: #4e73df;
    transform: scale(1.05);
    box-shadow: 0 4px 20px -5px rgba(0,0,0,0.15);
}
.launcher-card .card-body {
    min-height: 180px;
}
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Papan Pemuka RIMS@SISMAP</h1>
    <span class="text-muted">Sistem Maklumat Pilihan Raya</span>
</div>

<div class="row g-4 mb-5">
    <div class="col-lg-3 col-md-6">
        <div class="card card-gradient bg-gradient-primary shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase">Etnografi</h6>
                    <h2 class="display-6 fw-bold"><?= $bilanganSismap['harian'] ?? '0' ?></h2>
                </div>
                <i class="bx bx-data"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card card-gradient bg-gradient-success shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase">Pilihan Raya</h6>
                    <h2 class="display-6 fw-bold"><?= $bilanganSismap['pilihanraya'] ?? '0' ?></h2>
                </div>
                <i class="bx bxs-city"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card card-gradient bg-gradient-info shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase">Pencalonan</h6>
                    <h2 class="display-6 fw-bold"><?= $bilanganSismap['pencalonan'] ?? '0' ?></h2>
                </div>
                <i class="bx bx-food-menu"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card card-gradient bg-gradient-warning shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase">Parti Politik</h6>
                    <h2 class="display-6 fw-bold"><?= $bilanganSismap['parti'] ?? '0' ?></h2>
                </div>
                <i class="bx bx-flag"></i>
            </div>
        </div>
    </div>
</div>

<div class="mb-4">
    <h4 class="mb-3">Pelancaran Modul</h4>
    <div class="row g-4">
        <div class="col-lg-3 col-md-6">
            <a href="<?= site_url('harian') ?>" class="launcher-card">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="bx bx-data display-3 text-primary mb-3"></i>
                        <h5 class="card-title">Modul Etnografi</h5>
                        <p class="card-text small text-muted">Urus dan pantau laporan harian.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a href="<?= site_url('pilihanraya') ?>" class="launcher-card">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="bx bxs-city display-3 text-success mb-3"></i>
                        <h5 class="card-title">Modul Pilihan Raya</h5>
                        <p class="card-text small text-muted">Daftar dan urus rekod pilihan raya.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a href="<?= site_url('pencalonan') ?>" class="launcher-card">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="bx bx-food-menu display-3 text-info mb-3"></i>
                        <h5 class="card-title">Modul Pencalonan</h5>
                        <p class="card-text small text-muted">Urus maklumat calon dan keputusan.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a href="<?= site_url('parti') ?>" class="launcher-card">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="bx bx-flag display-3 text-warning mb-3"></i>
                        <h5 class="card-title">Modul Parti Politik</h5>
                        <p class="card-text small text-muted">Selenggara maklumat parti-parti politik.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>