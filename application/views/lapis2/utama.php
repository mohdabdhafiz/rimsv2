<?php
// Fungsi bantuan untuk mengira perbezaan masa
function time_ago($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'min',
        's' => 'saat',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' lalu' : 'sebentar tadi';
}
?>
<div class="pagetitle">
  <h1>Halaman Utama</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item active">Utama</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <!-- Kolum Kiri -->
        <div class="col-lg-8">
            <div class="row">
                <!-- Kad Selamat Datang -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Selamat Datang, <span><?= strtok($pengguna->nama_penuh, " ") ?>!</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="<?= base_url() ?>assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" style="width: 80px; height: 80px;">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1"><?= strtoupper($pengguna->nama_penuh) ?></h5>
                                    <p class="mb-0 text-muted"><?= strtoupper($pengguna->pekerjaan) ?></p>
                                    <p class="mb-0 text-muted"><?= strtoupper($pengguna->pengguna_tempat_tugas) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kad Navigasi Utama -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Navigasi Pantas</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <a href="<?= site_url("lapis2/tambahLaporan") ?>" class="card text-center text-decoration-none h-100 card-hover">
                                        <div class="card-body d-flex flex-column justify-content-center">
                                            <i class="bi bi-file-earmark-plus text-primary display-4"></i>
                                            <p class="card-text mt-2 mb-0 fw-bold">Tambah Laporan</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="<?= site_url("lapis2/senaraiLaporan") ?>" class="card text-center text-decoration-none h-100 card-hover">
                                        <div class="card-body d-flex flex-column justify-content-center">
                                            <i class="bi bi-list-columns-reverse text-info display-4"></i>
                                            <p class="card-text mt-2 mb-0 fw-bold">Senarai Laporan</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="<?= site_url("lapis2/dashboard") ?>" class="card text-center text-decoration-none h-100 card-hover">
                                        <div class="card-body d-flex flex-column justify-content-center">
                                            <i class="bi bi-speedometer2 text-success display-4"></i>
                                            <p class="card-text mt-2 mb-0 fw-bold">Dashboard</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Kolum Kiri -->

        <!-- Kolum Kanan -->
        <div class="col-lg-4">
            <!-- Kad Ringkasan Aktiviti -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ringkasan Aktiviti Terkini</h5>

                    <div class="activity">
                        <?php if (!empty($aktiviti_terkini)): ?>
                            <?php foreach($aktiviti_terkini as $aktiviti): ?>
                                <?php
                                    $badge_class = 'text-primary';
                                    $message = 'Status laporan <a href="'.site_url('lapis2/lihatLaporan/'.$aktiviti->lapis_bil).'" class="fw-bold text-dark">#'.$aktiviti->lapis_bil.'</a> dikemas kini kepada '.$aktiviti->lapis_status;

                                    if ($aktiviti->lapis_status == 'Laporan Diterima') {
                                        $badge_class = 'text-success';
                                        $message = 'Laporan baru <a href="'.site_url('lapis2/lihatLaporan/'.$aktiviti->lapis_bil).'" class="fw-bold text-dark">#'.$aktiviti->lapis_bil.'</a> telah dihantar.';
                                    } elseif ($aktiviti->lapis_status == 'Laporan Dipinda') {
                                        $badge_class = 'text-warning';
                                    } elseif ($aktiviti->lapis_status == 'Laporan Ditolak') {
                                        $badge_class = 'text-danger';
                                    }
                                ?>
                                <div class="activity-item d-flex">
                                    <div class="activite-label"><?= time_ago($aktiviti->lapis_waktu_dibina) ?></div>
                                    <i class='bi bi-circle-fill activity-badge <?= $badge_class ?> align-self-start'></i>
                                    <div class="activity-content">
                                        <?= $message ?>
                                    </div>
                                </div><!-- End activity item-->
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center text-muted">Tiada aktiviti terkini.</div>
                        <?php endif; ?>
                    </div>

                </div>
            </div><!-- End Recent Activity -->
        </div><!-- End Kolum Kanan -->

    </div>
</section>

<style>
    .card-hover {
        transition: transform .2s, box-shadow .2s;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
</style>
