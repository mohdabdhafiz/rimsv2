<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS@SISMAP</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('pencalonan') ?>">PENCALONAN</a></li>
                <li class="breadcrumb-item active"><?= strtoupper($pru->pilihanraya_nama) ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

        <section class="section">
            
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Calon <?= $pru->pilihanraya_singkatan ?></h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Nama Pilihan Raya</th>
                            <td><?= strtoupper($pru->pilihanraya_nama) ?></td>
                        </tr>
                        <tr>
                            <th>Nama Singkatan</th>
                            <td><?= strtoupper($pru->pilihanraya_singkatan) ?></td>
                        </tr>
                        <tr>
                            <th>Parlimen / DUN</th>
                            <td><?= strtoupper($pru->pilihanraya_jenis) ?></td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <td><?= $pru->pilihanraya_tahun ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?= $pru->pilihanraya_status ?></td>
                        </tr>
                        <tr>
                            <th>Tarikh Penamaan Calon</th>
                            <td><?= $pru->pilihanraya_penamaan_calon ?></td>
                        </tr>
                        <tr>
                            <th>Tarikh Lock Status</th>
                            <td><?= $pru->pilihanraya_lock_status ?></td>
                        </tr>
                        <tr>
                            <th>Disediakan Oleh</th>
                            <td><?= strtoupper($pru->nama_penuh) ?></td>
                        </tr>
                        <tr>
                            <th>Disediakan Pada</th>
                            <td><?= $pru->pilihanraya_waktu ?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
        </div>

        <?php if($pru->pilihanraya_jenis == 'PARLIMEN'): ?>
        <?php foreach($senaraiParlimen as $parlimen): ?>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title"><?= strtoupper($parlimen->pt_nama) ?></h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Parti</th>
                                <th class="text-center">Gambar Calon</th>
                                <th>Maklumat Diri</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiPencalonan as $calon):
                                if($parlimen->pt_bil == $calon->pencalonan_parlimen_parlimenBil): ?>
                            <tr>
                                <td style="<?= $calon->parti_warna ?>" class="text-center" valign="middle">
                                    <h1 class="display-5"><?= $calon->parti_singkatan ?></h1>
                                    <p><?= strtoupper($calon->parti_nama) ?></p>
                                </td>
                                <td class="text-center">
                                    <img src="<?php echo base_url('assets/img/').$calon->foto_nama; ?>" alt="Gambar <?php echo $calon->ahli_nama; ?>" class="mb-3" style="border-radius:5%; width:200px; height:200px; object-fit:cover;">
                                    <p><strong><?= strtoupper($calon->ahli_nama) ?></strong></p>
                                </td>
                                <td>
                                    <strong>Umur : </strong><?= $calon->ahli_umur ?><br>
                                    <strong>Asal : </strong>BELUM DIBINA<br>
                                    <strong>Jawatan Parti : </strong>BELUM DIBINA<br>
                                    <strong>Kerjaya : </strong>BELUM DIBINA<br>
                                    <strong>Pendidikan : </strong><?= strtoupper($calon->ahli_pendidikan) ?><br>
                                    <strong>Penglibatan : </strong>BELUM DIBINA<br>
                                    <strong>Jantina : </strong><?= strtoupper($calon->ahli_jantina) ?><br>
                                    <strong>Kaum : </strong><?= strtoupper($calon->ahli_kaum) ?>
                                </td>
                            </tr>
                            <?php 
                                endif;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <?php if($pru->pilihanraya_jenis == 'DUN'): ?>
        <?php foreach($senaraiDun as $dun): ?>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title"><?= strtoupper($dun->dun_nama) ?></h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                            <tr>
                                <th class="text-center">Parti</th>
                                <th class="text-center">Gambar Calon</th>
                                <th>Maklumat Diri</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiPencalonan as $calon):
                                if($dun->dun_bil == $calon->pencalonan_dun): ?>
                            <tr>
                                <td style="<?= $calon->parti_warna ?>" class="text-center" valign="middle">
                                    <h1 class="display-5"><?= $calon->parti_singkatan ?></h1>
                                    <p><?= strtoupper($calon->parti_nama) ?></p>
                                </td>
                                <td class="text-center">
                                    <img src="<?php echo base_url('assets/img/').$calon->foto_nama; ?>" alt="Gambar <?php echo $calon->ahli_nama; ?>" class="mb-3" style="border-radius:5%; width:200px; height:200px; object-fit:cover;">
                                    <p><strong><?= strtoupper($calon->ahli_nama) ?></strong></p>
                                </td>
                                <td>
                                    <strong>Umur : </strong><?= $calon->ahli_umur ?><br>
                                    <strong>Asal : </strong>BELUM DIBINA<br>
                                    <strong>Jawatan Parti : </strong>BELUM DIBINA<br>
                                    <strong>Kerjaya : </strong>BELUM DIBINA<br>
                                    <strong>Pendidikan : </strong><?= strtoupper($calon->ahli_pendidikan) ?><br>
                                    <strong>Penglibatan : </strong>BELUM DIBINA<br>
                                    <strong>Jantina : </strong><?= strtoupper($calon->ahli_jantina) ?><br>
                                    <strong>Kaum : </strong><?= strtoupper($calon->ahli_kaum) ?>
                                </td>
                            </tr>
                            <?php 
                                endif;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        </section>
</main>


<?php $this->load->view($footer); ?>