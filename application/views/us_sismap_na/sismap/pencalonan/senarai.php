<?php

$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/navbar');
$this->load->view('us_sismap_na/susunletak/sidebar');
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS</a></li>
                <li class="breadcrumb-item active">RIMS@SISMAP</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

        <section class="section">
            
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Pencalonan <?= $pru->pilihanraya_singkatan ?></h1>
                
            </div>
        </div>

        <?php if($pru->pilihanraya_jenis == 'PARLIMEN'): ?>
        <?php foreach($senaraiParlimen as $parlimen): ?>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title"><?= $parlimen->pt_nama ?></h1>
                <div class="table-responsive">
                    <table class="table table-sm datatable">
                        <thead>
                            <tr>
                                <th>Gambar Calon</th>
                                <th>Nama</th>
                                <th>Jantina</th>
                                <th>Umur</th>
                                <th>Parti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiPencalonan as $calon):
                                if($parlimen->pt_bil == $calon->pencalonan_parlimen_parlimenBil): ?>
                            <tr>
                                <td><img src="<?php echo base_url('assets/img/').$calon->foto_nama; ?>" alt="Gambar <?php echo $calon->ahli_nama; ?>" class="" style="border-radius:50%; width:200px; height:200px; object-fit:cover;"></td>
                                <td><?= $calon->ahli_nama ?></td>
                                <td><?= $calon->ahli_jantina ?></td>
                                <td><?= $calon->ahli_umur ?></td>
                                <td><?= $calon->parti_nama ?> (<?= $calon->parti_singkatan ?>)</td>
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
                <h1 class="card-title"><?= $dun->dun_nama ?></h1>
                <div class="table-responsive">
                    <table class="table table-sm datatable">
                        <thead>
                            <tr>
                                <th>Gambar Calon</th>
                                <th>Nama</th>
                                <th>Jantina</th>
                                <th>Umur</th>
                                <th>Parti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiPencalonan as $calon):
                                if($dun->dun_bil == $calon->pencalonan_dun): ?>
                            <tr>
                                <td><img src="<?php echo base_url('assets/img/').$calon->foto_nama; ?>" alt="Gambar <?php echo $calon->ahli_nama; ?>" class="" style="border-radius:50%; width:200px; height:200px; object-fit:cover;"></td>
                                <td><?= $calon->ahli_nama ?></td>
                                <td><?= $calon->ahli_jantina ?></td>
                                <td><?= $calon->ahli_umur ?></td>
                                <td><?= $calon->parti_nama ?> (<?= $calon->parti_singkatan ?>)</td>
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
</div>
</div>

<?php
$this->load->view('us_sismap_na/susunletak/bawah');
?>