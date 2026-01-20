<style>

/* Styling Kotak & Hover */
.module-link-box {
    background-color: #fff;
    transition: all 0.3s ease-in-out;
    border: 1px solid #eef1f6 !important;
}

.module-link-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    background-color: #fbfbfb;
    border-color: #dce0e5 !important;
}

/* Styling Ikon */
.card-icon {
    font-size: 24px;
    width: 50px;
    height: 50px;
    line-height: 0;
    flex-shrink: 0;
}

/* Tema Warna 1: Sales (Biru - Parlimen) */
.sales-theme .card-icon {
    color: #4154f1;
    background: #f6f6fe;
}

/* Tema Warna 2: Revenue (Hijau - DUN) */
.revenue-theme .card-icon {
    color: #2eca6a;
    background: #e0f8e9;
}

</style>

<div class="pagetitle">
    <h1>RIMS@SISMAP</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">UTAMA</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('dm') ?>">DAERAH MENGUNDI</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row g-3">
    
    <div class="col-md-6">
        <a href="<?= site_url('parlimen/tambah_dm') ?>" class="module-link-box card-hover-effect sales-theme text-decoration-none p-3 d-flex align-items-center border rounded h-100">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-building"></i>
            </div>
            <div class="ps-3">
                <h6 class="mb-0 fw-bold text-dark">DM Parlimen</h6>
                <span class="text-muted small">Mengemaskini Maklumat Daerah Mengundi Parlimen</span>
            </div>
        </a>
    </div>

    <div class="col-md-6">
        <a href="<?= site_url('dun/tambah_dm') ?>" class="module-link-box card-hover-effect revenue-theme text-decoration-none p-3 d-flex align-items-center border rounded h-100">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-map"></i>
            </div>
            <div class="ps-3">
                <h6 class="mb-0 fw-bold text-dark">DM DUN</h6>
                <span class="text-muted small">Mengemaskini Maklumat Daerah Mengundi DUN</span>
            </div>
        </a>
    </div>

</div>