<!-- Senarai Petugas Mengikut PRU dengan NiceAdmin Theme -->

<!-- Pastikan anda sudah include CSS dan JS NiceAdmin di layout utama anda -->

<div class="pagetitle">
    <h1>Senarai Petugas Mengikut PRU</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('sismap') ?>">RIMS@SISMAP</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('pegawai') ?>">Petugas</a></li>
            <li class="breadcrumb-item active">Senarai Petugas Mengikut PRU</li>
        </ol>
    </nav>
</div>

<section class="section">

<?php if (!empty($pru) && is_object($pru)): ?>
<div class="card shadow-sm mb-4">
    <div class="card-body">
    <h1 class="card-title"><?= htmlspecialchars($pru->pilihanraya_nama) ?></h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">NOMBOR SIRI</th>
                        <th>NAMA PILIHAN RAYA</th>
                        <th>SINGKATAN</th>
                        <th>TARIKH PENAMAAN CALON</th>
                        <th>TARIKH LOCK STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center fw-bold"><?= $pru->pilihanraya_bil ?></td>
                        <td>
                            <span class="badge bg-info text-dark"><?= htmlspecialchars($pru->pilihanraya_nama) ?></span>
                        </td>
                        <td>
                            <span class="badge bg-secondary"><?= htmlspecialchars($pru->pilihanraya_singkatan) ?></span>
                        </td>
                        <td>
                            <i class="bi bi-clock me-1"></i><?= htmlspecialchars($pru->pilihanraya_penamaan_calon) ?>
                        </td>
                        <td>
                            <i class="bi bi-clock me-1"></i><?= htmlspecialchars($pru->pilihanraya_lock_status) ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php else: ?>
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white d-flex align-items-center">
        <i class="bi bi-calendar-event me-2"></i>
        <span class="fs-5">Pilihan Raya Umum</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">BIL</th>
                        <th>NAMA PILIHAN RAYA</th>
                        <th>SINGKATAN</th>
                        <th>TARIKH</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Tiada data pilihan raya.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Senarai Petugas</h5>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nombor Siri</th>
                                    <th scope="col">Nama Petugas</th>
                                    <th scope="col">No. Kad Pengenalan</th>
                                    <th scope="col">Jawatan</th>
                                    <th scope="col">PRU</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($petugas_list)): ?>
                                    <?php foreach ($petugas_list as $petugas): ?>
                                        <tr>
                                            <td><?= $petugas->pg_bil ?></td>
                                            <td><?= htmlspecialchars($petugas->pg_nama) ?></td>
                                            <td><?= htmlspecialchars($petugas->pg_ic) ?></td>
                                            <td><?= htmlspecialchars($petugas->pg_jawatan) ?></td>
                                            <td><?= htmlspecialchars($petugas->pru_nama) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Tiada data petugas.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>