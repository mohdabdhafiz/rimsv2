<?php
// $tugasan_list: array of tugasan, setiap tugasan ada pengguna_bil, tugasan_nama, tugasan_status, tugasan_tarikh, dll

// Kumpulkan tugasan mengikut pengguna_bil
$tugasan_by_pengguna = [];
if (!empty($tugasan_list)) {
    foreach ($tugasan_list as $tugasan) {
        $tugasan_by_pengguna[$tugasan->pengguna_bil][] = $tugasan;
    }
}
?>

<div class="card mb-4">
    <div class="card-header bg-primary text-white mb-3">
        <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i>Maklumat Pegawai</h5>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <strong>Nama Pegawai:</strong>
                <span class="ms-2"><?php echo htmlspecialchars($pegawai->nama_penuh); ?></span>
            </li>
            <li class="list-group-item">
                <strong>Jawatan:</strong>
                <span class="ms-2"><?php echo htmlspecialchars($pegawai->pekerjaan); ?></span>
            </li>
            <li class="list-group-item">
                <strong>Bahagian:</strong>
                <span class="ms-2"><?php echo htmlspecialchars($pegawai->pengguna_tempat_tugas); ?></span>
            </li>
        </ul>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-info text-white mb-3">
        <h5 class="mb-0">
            <i class="bi bi-list-check me-2"></i>
            Senarai Pilihan Raya Mengikut Pengguna : <?php echo htmlspecialchars($pegawai->nama_penuh); ?>
        </h5>
    </div>
    <div class="card-body">
        <?php
        // Kumpulkan pilihanraya mengikut pengguna_bil
        $pilihanraya_by_pengguna = [];
        if (!empty($pilihanraya_list)) {
            foreach ($pilihanraya_list as $pilihanraya) {
                $pilihanraya_by_pengguna[$pilihanraya->pengguna_bil][] = $pilihanraya;
            }
        }
        ?>
        <?php if (!empty($pilihanraya_by_pengguna)) { ?>
            <?php foreach ($pilihanraya_by_pengguna as $pengguna_bil => $pilihanraya_arr) { ?>
                <div class="mb-4">
                    <h6 class="fw-bold text-primary">
                        <i class="bi bi-person-badge me-1"></i>
                        Pengguna ID: <?php echo htmlspecialchars($pengguna_bil); ?>
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Pilihan Raya</th>
                                    <th scope="col">Tarikh Dibuat</th>
                                    <th scope="col">Tarikh Diubah</th>
                                    <th scope="col">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pilihanraya_arr as $idx => $pilihanraya) { ?>
                                    <tr>
                                        <td><?php echo $idx + 1; ?></td>
                                        <td><?php echo htmlspecialchars($pilihanraya->pru_nama); ?></td>
                                        <td><?php echo htmlspecialchars($pilihanraya->pg_dicipta_pada); ?></td>
                                        <td><?php echo htmlspecialchars($pilihanraya->pg_diubah_pada); ?></td>
                                        <td><?php echo htmlspecialchars($pilihanraya->pg_catatan); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Tiada pilihan raya dijumpai.
            </div>
        <?php } ?>
        <a href="<?php echo site_url('pegawai/senarai'); ?>" class="btn btn-outline-info mt-3">
            <i class="bi bi-arrow-left"></i> Kembali ke Senarai Petugas Pilihan Raya
        </a>
    </div>
</div>
