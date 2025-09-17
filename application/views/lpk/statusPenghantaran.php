<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
    <h1>RIMS@LPK</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('sentimen') ?>">RIMS@LPK</a></li>
            <li class="breadcrumb-item active">Senarai Laporan Persepsi Terhadap Kerajaan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

    <section class="section">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title">Status Penghantaran Laporan bagi Tahun 2025</h5>
        <p>Bilangan Anggota : <?= count($senaraiPelapor) ?></p>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Nama Pelapor</th>
                        <th scope="col" class="text-center">Jawatan</th>
                        <th scope="col" class="text-center">Penempatan</th>
                        <th scope="col" class="text-center">Bilangan Laporan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($senaraiPelapor)): ?>
                        <!-- Loop through the list of reporters and display their data -->
                        <?php foreach ($senaraiPelapor as $pelapor): ?>
                            <tr>
                                <td><?= $pelapor->bil ?></td>
                                <td><?= htmlspecialchars($pelapor->nama_penuh, ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($pelapor->jawatan, ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($pelapor->penempatan, ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="text-end"><?= $pelapor->jumlah_laporan ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Show a message when no data is available -->
                        <tr>
                            <td colspan="3" class="text-center">Tiada data tersedia</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    </section>

</main>

<?php $this->load->view($footer); ?>
