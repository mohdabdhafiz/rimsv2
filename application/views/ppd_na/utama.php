<?php 
$this->load->view($header);
$this->load->view($navbar);
$this->load->view($sidebar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?= base_url() ?>">UTAMA</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="col-12">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">RIMS@PERSONEL <span>| MAKLUMAT PENGGUNA</span></h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person"></i>
                </div>
                <div class="ps-3">
                    <h6><?= strtoupper($pengguna->nama_penuh) ?></h6>
                    <span class="text-muted small pt-2">
                        <?= strtoupper($pengguna->pekerjaan) ?>
                        
                        <?php if(!empty($organisasi)): ?>
                            | <?= strtoupper($organisasi->jt_pejabat) ?>
                        <?php elseif(!empty($pengguna->pengguna_tempat_tugas)): ?>
                            | <?= strtoupper($pengguna->pengguna_tempat_tugas) ?>
                        <?php endif; ?>

                        <?php if(!empty($ppd) && $pengguna->bil == $ppd->bil): ?>
                            <br><em>Pegawai Penerangan Daerah / Menjalankan tugas</em>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">RIMS@SISMAP <span>| SISTEM MAKLUMAT PILIHAN RAYA</span></h5>

        <div class="row g-3">

            <div class="col-md-6 col-lg-4">
                <a href="<?= site_url('dm') ?>" class="module-link-box card-hover-effect info-theme text-decoration-none p-3 d-flex align-items-center border rounded">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-geo-alt-fill"></i> 
                    </div>
                    <div class="ps-3">
                        <h6 class="mb-0 fw-bold text-dark">Daerah Mengundi</h6>
                        <span class="text-muted small">Mengemaskini Maklumat Bilangan Pengundi Terkini</span>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="<?= site_url('jangkaan') ?>" class="module-link-box card-hover-effect sales-theme text-decoration-none p-3 d-flex align-items-center border rounded">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <h6 class="mb-0 fw-bold text-dark">Jangkaan</h6>
                        <span class="text-muted small">Analisa Calon</span>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="<?= site_url('petugas') ?>" class="module-link-box card-hover-effect customers-theme text-decoration-none p-3 d-flex align-items-center border rounded">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="ps-3">
                        <h6 class="mb-0 fw-bold text-dark">Petugas</h6>
                        <span class="text-muted small">SD & Lantikan</span>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="<?= site_url('penamaan') ?>" class="module-link-box card-hover-effect revenue-theme text-decoration-none p-3 d-flex align-items-center border rounded">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div class="ps-3">
                        <h6 class="mb-0 fw-bold text-dark">Penamaan</h6>
                        <span class="text-muted small">Borang Rasmi</span>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="<?= site_url('kempen') ?>" class="module-link-box card-hover-effect danger-theme text-decoration-none p-3 d-flex align-items-center border rounded">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-megaphone"></i>
                    </div>
                    <div class="ps-3">
                        <h6 class="mb-0 fw-bold text-dark">Aktiviti</h6>
                        <span class="text-muted small">Laporan Kempen</span>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="<?= site_url('grading') ?>" class="module-link-box card-hover-effect purple-theme text-decoration-none p-3 d-flex align-items-center border rounded">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-bar-chart-line"></i>
                    </div>
                    <div class="ps-3">
                        <h6 class="mb-0 fw-bold text-dark">Culaan</h6>
                        <span class="text-muted small">Statistik Grading</span>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="<?= site_url('undi') ?>" class="module-link-box card-hover-effect dark-theme text-decoration-none p-3 d-flex align-items-center border rounded">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="ps-3">
                        <h6 class="mb-0 fw-bold text-dark">Keputusan</h6>
                        <span class="text-muted small">Hari Undi</span>
                    </div>
                </a>
            </div>

        </div> </div>
</div>
    
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@LAPIS
            <span class="text-muted"> | LAPORAN ISU SETEMPAT</span>
            </h1>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">BIL</th>
                        <th width="50%">TUGASAN</th>
                        <th class="text-center">BILANGAN LAPORAN</th>
                        <th class="text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Mengisi borang isu harian</td>
                        <td class="text-center">Tidak Berkenaan</td>
                        <td class="text-center">
                        <a href="<?= site_url('lapis/pilih_kluster') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-node-plus"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Melihat laporan bagi tahun <?= date('Y') ?></td>
                        <td class="text-center"><?= $bilanganLaporanLapis ?></td>
                        <td class="text-center">
                        <a href="<?= site_url('lapis') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@LPK
            <span class="text-muted"> | LAPORAN PERSEPSI TERHADAP KERAJAAN</span>
            </h1>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">BIL</th>
                        <th width="50%">TUGASAN</th>
                        <th class="text-center">BILANGAN LAPORAN</th>
                        <th class="text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Mengisi Laporan Persepsi Terhadap Kerajaan terkini</td>
                        <td class="text-center">Tidak Berkenaan</td>
                        <td class="text-center">
                            <a href="<?= site_url('sentimen/borang') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-node-plus"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Melihat laporan</td>
                        <td class="text-center"><?= $bilanganLaporanLks ?></td>
                        <td class="text-center">
                        <a href="<?= site_url('sentimen/senarai') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Melihat laporan organisasi</td>
                        <td class="text-center"><?= $bilanganPenuhLpk ?></td>
                        <td class="text-center">
                        <a href="<?= site_url('sentimen/mengikutSenaraiAnggota') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    </section>

</main>

<?php $this->load->view($footer); ?>