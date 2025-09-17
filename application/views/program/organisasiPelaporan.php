<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('program') ?>">Utama</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <a href="<?= site_url('program') ?>" class="btn btn-outline-info shadow-sm mb-3">Kembali</a>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Penghantaran Laporan Mengikut JAPEN Negeri dan PPD</h1>
            <p class="text-danger">Nota: Dalam Pembinaan dan Penyelidikan</p>
            <?php foreach($senaraiIpn as $ipn):
                $senaraiNegeri = $dataPeranan->tugasNegeriPeranan($ipn->perananBil);
                ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Organisasi</th>
                        <th>Bilangan Perancangan (Jadual Aktiviti)</th>
                        <th>Bilangan Pelaksanaan (Selesai)</th>
                        <th>Jumlah Laporan Keseluruhan</th>
                    </tr>
                    <tr>
                        <th><?= strtoupper($ipn->organisasiNama) ?> <?= strtoupper($ipn->perananNama) ?>
                        <?php foreach($senaraiNegeri as $negeri): ?>
                            | <?= strtoupper($negeri->nt_nama) ?>
                        <?php endforeach; ?>    
                    </th>
                    <td><?= $ipn->bilanganPerancangan ?></td>
                    <td><?= $ipn->bilanganPelaksanaan ?></td>
                    <td><?= $ipn->jumlahLaporan ?></td>
                    </tr>
                    <?php foreach($senaraiNegeri as $negeri): 
                        $senaraiPpd = $dataPeranan->senaraiPerananPpdNegeri($negeri->nt_bil);
                        foreach($senaraiPpd as $ppd):
                        ?>
                        <tr>
                            <th>
                            <?= strtoupper($ppd->organisasiNama) ?>
                        </th>
                        <td><?= $ppd->bilanganPerancangan ?></td>
                        <td><?= $ppd->bilanganPelaksanaan ?></td>
                        <td><?= $ppd->jumlahLaporan ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    


    </section>


</main>


<?php $this->load->view($footer); ?>